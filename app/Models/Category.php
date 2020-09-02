<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
// use Cviebrock\EloquentSluggable\Sluggable;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


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

    public  $path;

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute');
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

        $this->path = $this->isRoot() ? $slug : $this->parent->path.'/'.$slug;

        return $this;
    }

    // Получение ссылки
    public function getUrl()
    {
        return 'catalog/'.$this->path;
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

    public static function getStatusUser() {
        $user = Auth::user();
       return [
           'user_id' => $user->id,
           'status' => ($user->role == User::ROLE_SELLER) ? Category::STATUS_CAT_CORRECTION : Category::STATUS_CAT_ACTIVE,
       ];
    }

    public static function getAllCategory() {
        return Cache::remember('getAllCategory', 21600, function() {
            return Category::defaultOrder()->withDepth()->get();
        });
    }

    public function isActive() {
       if ($this->status == Category::STATUS_CAT_ACTIVE) return true;
       return false;
    }

    public static function getSlug ($value)
    {
        return Str::of($value)->slug('-');
    }


}
