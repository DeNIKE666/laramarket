<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * Список статусов
     */
    public const STATUS_PRODUCT_ACTIVE = 'active';
    public const STATUS_PRODUCT_CORRECTION = 'correction';
    public const STATUS_PRODUCT_DRAW = 'draw';

    /**
     * Типы товара
     */
    public const TYPE_PRODUCT_FIZ = 'fiz';
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
        'part_cashback'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = Str::of($value)->slug('-');
    }


    public  static function add($fields)
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
        if($id == null) {return;}
        $this->category_id = $id;
        $this->save();
    }

    public function setDraft()
    {
        $this->status = 0;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = 1;
        $this->save();
    }

    public function toogleStatus($value)
    {
        if($value == null) {
            return $this->setDraft();
        }
        return $this->setPublic();
    }


    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300);
    }

    public function getUrl() {
        return '/product/' . $this->slug;
    }

    public function getImage($size='') {
        if($this->getMedia('image')->first()) {
            return '<img class="img-fluid" alt="" src="' . $this->getMedia('image')->first()->getUrl($size) . '" >';
        }
    }
    public function getImageSrc($size='') {
        if($this->getMedia('image')->first()) {
            return $this->getMedia('image')->first()->getUrl($size);
        }
    }

    public function getGallery() {
        return $this->getMedia('gallery')->all();
    }

    public function getCost()
    {
        return number_format($this->price, 0, '', ' ') . ' &#8381;';
    }
}
