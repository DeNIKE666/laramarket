<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository
{
    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Получить категорию по slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function getSingleBySlug(string $slug): Category
    {
        return $this
            ->model
            ->query()
            ->where(compact('slug'))
            ->firstOrFail();
    }
}