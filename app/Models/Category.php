<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
 use Cviebrock\EloquentSluggable\Sluggable;
use Auth;


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

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = Str::of($value)->slug('-');
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
         'status' => ($user->role == User::ROLE_SHOP) ? Category::STATUS_CAT_CORRECTION : Category::STATUS_CAT_ACTIVE,
       ];
    }

    public static function getAllCategory() {
        return Category::defaultOrder()->withDepth()->get();
    }

    public function isActive() {
       if ($this->status == Category::STATUS_CAT_ACTIVE) return true;
       return false;
    }



    /*protected static function boot()
    {
        static::saving(function (self $model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->generatePath();
            }
        });

        static::saved(function (self $model) {
            // Данная переменная нужна для того, чтобы потомки не начали вызывать
            // метод, т.к. для них путь также изменится
            static $updating = false;

            if ( ! $updating && $model->isDirty('path')) {
                $updating = true;

                $model->updateDescendantsPaths();

                $updating = false;
            }
        });
    }*/
}
