<?php

namespace App\Models;

use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    /**
     * Список статусов
     */
    public const STATUS_PRODUCT_ACTIVE = 'active';
    public const STATUS_PRODUCT_CORRECTION = 'correction';
    public const STATUS_PRODUCT_DRAW = 'draw';

    /**
     * Типы товара
     */
    public const TYPE_PRODUCT_REAL = 'real';
    public const TYPE_PRODUCT_INFO = 'info';

    /**
     * Количество товаров на странице
     */
    public const PAGINATE = 10;

    /**
     * Название куки просмотров
     */
    public const COOKVIEWS = 'you_views';

    protected $fillable = [
        'title',
        'category_id',
        'content',
        'user_id',
        'price',
        'old_price',
        'group_product',
        'part_cashback',
        'slug',
        'brand',
        'status',
    ];

    protected $sortable = [
        'id',
        'views',
        'price',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    /*
        public function setTitleAttribute($value)
        {
            return $this->attributes['title'] = Str::of($value)->slug('-');
        }
    */

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImg();
        $this->delete();
    }

    public function setCategory($id)
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function registerMediaConversions(Media $media = null)
    {

        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('medium')
            ->width(460)
            ->height(360);
    }

    public function getUrl()
    {
        return '/product/' . $this->slug;
    }

    public function getImage($size = '')
    {
        $img = $this->getMedia('image')->first();
        if ($img) {
            return '<img class="img-fluid" alt="" src="' . $img->getUrl($size) . '" >';
        }
    }

    public function getImageAdmin($size = '')
    {
        if ($this->getMedia('image')->first()) {
            return '<div class="lcPageAddImg">
                            <div class="lcPageAddImg__btns">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="24px">
                                    <path fill-rule="evenodd" fill="rgb(174, 174, 180)" d="M12.923,-0.012 C6.248,-0.012 0.838,5.360 0.838,11.987 C0.838,18.612 6.248,23.985 12.923,23.985 C19.601,23.985 25.012,18.612 25.012,11.987 C25.012,5.360 19.601,-0.012 12.923,-0.012 ZM18.120,15.236 L16.195,17.144 C16.195,17.144 13.150,13.901 12.922,13.901 C12.698,13.901 9.652,17.144 9.652,17.144 L7.726,15.236 C7.726,15.236 10.997,12.256 10.997,11.991 C10.997,11.722 7.726,8.742 7.726,8.742 L9.652,6.829 C9.652,6.829 12.723,10.074 12.922,10.074 C13.122,10.074 16.195,6.829 16.195,6.829 L18.120,8.742 C18.120,8.742 14.848,11.765 14.848,11.991 C14.848,12.207 18.120,15.236 18.120,15.236 Z"></path>
                                </svg>
                            </div>
                            <div class="lcPageAddImg__img">
                                <img src="' . $this->getMedia('image')->first()->getUrl($size) . '" alt="">
                            </div>
                        </div>';
            //return '<img class="img-fluid" alt="" src="' . $this->getMedia('image')->first()->getUrl($size) . '" >';
        }
    }

    public function getImageSrc($size = '')
    {
        if ($this->getMedia('image')->first()) {
            return $this->getMedia('image')->first()->getUrl($size);
        }
    }

    public function getGallery()
    {
        return $this->getMedia('gallery')->all();
    }

    public function getCost()
    {
        return number_format($this->price, 0, '', ' ') . ' руб';
    }

    public static function getProductsById(array $ids = [])
    {
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $result[] = Product::staticFindProductById($id);
            }
            return $result;
        } else {
            return [];
        }
    }

    public static function ViewsId()
    {
        if (isset($_COOKIE[Product::COOKVIEWS])) {
            $value = $_COOKIE[Product::COOKVIEWS];
            return explode("|", $value);
        } else {
            return [];
        }
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public static function staticFindProductById(int $id)
    {
        try {
            return \Cache::remember('product_id_' . $id, 3600, function () use ($id) {
                return Product::findOrFail($id);
            });
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }

    }

    public static function getPopularProductById()
    {
        return \Cache::remember('popular_products_id', 3600, function () {
            return Product::where('status', Product::STATUS_PRODUCT_ACTIVE)
                ->orderByDesc('views')
                ->limit(4)
                ->pluck('id')
                ->toArray();
        });
    }

    /**
     * Активные товары
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', 'active');
    }

    /**
     * Фильтр по атрибутам
     *
     * @param Builder $builder
     * @param array   $ids
     *
     * @return Builder
     * @author Anton Reviakin
     */
    public function scopeFilterByAttributes(Builder $builder, array $ids = []): Builder
    {
        if (empty($ids)) {
            return $builder;
        }

        return $builder
            ->whereHas('productAttributes', function (Builder $builder) use ($ids) {
                return $builder->whereIn('id', array_values($ids));
            });
    }

    /**
     * Фильтр по ценам
     *
     * @param Builder   $builder
     * @param float|int $min
     * @param float|int $max
     *
     * @return Builder
     * @author Anton Reviakin
     */
    public function scopeBetweenPrices(Builder $builder, int $min = 0, int $max = 0): Builder
    {
        if ($min === 0 or $max === 0 or $max < $min) {
            return $builder;
        }

        return $builder->whereBetween('price', [$min, $max]);
    }

    /**
     * Сортировка по полю
     *
     * @param Builder $builder
     * @param string  $column
     * @param string  $dir
     *
     * @return Builder
     */
    public function scopeSortBy(Builder $builder, string $column, string $dir = 'asc')
    {
        if (!in_array($dir, ['asc', 'desc']) or !in_array($column, $this->sortable)) {
            return $builder;
        }

        return $builder->orderBy($column, $dir);
    }
}
