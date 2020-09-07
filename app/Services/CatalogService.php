<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CatalogService
{
    /** @var CategoryRepository $categoryRepository */
    private $categoryRepository;

    /** @var ProductRepository $productRepository */
    private $productRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    public function getCatalogWithFilters(array $request, string $slug)
    {
        /** @var Category $category */
        $category = $this
            ->categoryRepository
            ->getSingleBySlug($slug);

        //Потомки
        $descendants = $this->getDescendants($category);

        //Каталог фильтров
        $catFilter = $this->getFilterCatalog($category);

        //Фильтры
        $filterAttributes = $this->getFilterAttributes($request);

        /** @var LengthAwarePaginator $products */
        $products = $this
            ->productRepository
            ->getProductsByCategoryBuilder($descendants)
            ->active()                              //Активные
            ->filterByAttributes($filterAttributes) //Фильтрация по атрибутам
            ->betweenPrices(                        //Фильтр по ценам
                Arr::get($request, 'min_price', 0),
                Arr::get($request, 'max_price', 0),
            )
            ->paginate(Product::PAGINATE);

        //Минимальная и максимальная цены в выборке
        $minPrice = (int)$products->min('price');
        $maxPrice = (int)$products->max('price');

        return compact('category', 'descendants', 'filterAttributes', 'catFilter', 'minPrice', 'maxPrice', 'products');
    }

    /**
     * Потомки
     *
     * @param Category $category
     *
     * @return array
     */
    private function getDescendants(Category $category): array
    {
        $descendants = $category
            ->descendants()
            ->defaultOrder()
            ->pluck('id')
            ->toArray();

        $descendants[] = $category->id;

        return $descendants;
    }

    /**
     * Каталог фильтров
     *
     * @param Category $category
     *
     * @return Collection
     */
    private function getFilterCatalog(Category $category): Collection
    {
        return $category
            ->attributesWithValues()
            ->where('is_filter', true)
            ->get();
    }

    /**
     * Атрибуты для фильтрации
     *
     * @param array $request
     *
     * @return array
     */
    private function getFilterAttributes(array $request): array
    {
        return !empty($request['attributes'])
            ? explode(';', $request['attributes'])
            : [];
    }
}