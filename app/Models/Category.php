<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use NodeTrait;

    /**
     * Список статусов
     */
    public const STATUS_CAT_ACTIVE = 'active';
    public const STATUS_CAT_CORRECTION = 'correction';

    public const PARENT_LINK = 'catalog';

    protected $fillable = ['title', 'parent_id', 'content', 'user_id', 'status', 'slug'];

    public $path;

    /**
     * Характеристики
     *
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Характеристики со значениями
     *
     * @return BelongsToMany
     */
    public function attributesWithValues(): BelongsToMany
    {
        return $this
            ->belongsToMany(Attribute::class)
            ->with('children');
    }
    
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function getPath(): string
    {
        return '/' . Category::PARENT_LINK . '/' . $this->slug;
    }

    // Генерация пути
    public function generatePath()
    {
        $slug = $this->slug;

        $this->path = $this->isRoot() ? $slug : $this->parent->path . '/' . $slug;

        return $this;
    }

    // Получение ссылки
    public function getUrl()
    {
        return 'catalog/' . $this->path;
    }

    public function updateDescendantsPaths()
    {
        // Получаем всех потомков в древовидном порядке
        $descendants = $this->descendants()->defaultOrder()->get();

        // Данный метод заполняет отношения parent и children
        $descendants->push($this)->linkNodes()->pop();

        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }

    public static function getStatusUser()
    {
        $user = Auth::user();
        return [
            'user_id' => $user->id,
            'status'  => ($user->role == User::ROLE_SELLER) ? Category::STATUS_CAT_CORRECTION : Category::STATUS_CAT_ACTIVE,
        ];
    }

    public static function getAllCategory()
    {
        return Cache::remember('getAllCategory', 21600, function () {
            return Category::defaultOrder()->withDepth()->get();
        });
    }

    public function isActive()
    {
        if ($this->status == Category::STATUS_CAT_ACTIVE) return true;
        return false;
    }

    public static function getSlug($value)
    {
        return Str::of($value)->slug('-');
    }


}
