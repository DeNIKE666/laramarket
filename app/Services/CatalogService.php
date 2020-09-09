<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class CatalogService
 *
 * @package App\Services
 * @author  Anton Reviakin
 */
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

    /**
     * Каталог с фильтрами и сортировкой
     *
     * @param array  $request
     * @param string $slug
     *
     * @return array
     */
    public function getCatalogWithFilters(array $request, string $slug): array
    {
        $this->parseRequestFilter($request);

        /** @var Category $category */
        $category = $this
            ->categoryRepository
            ->getSingleBySlug($slug);

        //Категории-потомки
        $descendants = $this->getDescendants($category);

        //Каталог фильтров
        $catFilter = $this->getFilterAttrOfCatalog($category);

        //Атрибуты для фильтрации
        $filter = $this->parseRequestFilter($request);

        //Сортировка
        $sort = $this->getSortableColumns($request);

        /** @var LengthAwarePaginator $products */
        $products = $this
            ->productRepository
            ->getProductsByCategoryBuilder($descendants)
            ->active()                                  //Активные
            ->filterByAttributes($filter['attributes']) //Фильтрация по атрибутам
            ->betweenPrices(                            //Фильтр по ценам
                $filter['prices']['min'],
                $filter['prices']['max'],
            )
            ->sortBy(
                $sort['column'],
                $sort['direction']
            )
            ->paginate(Product::PAGINATE);

        //Минимальная и максимальная цены в выборке
        $minPrice = 1;
        $maxPrice = 101;

        return compact('category', 'descendants', 'catFilter', 'minPrice', 'maxPrice', 'products');
    }

    /**
     * Распарсить фильтры
     *
     * @param array $request
     *
     * @return array
     */
    private function parseRequestFilter(array $request): array
    {
        $filter = Arr::get($request, 'filter', '{}');
        $filter = json_decode($filter, true);

        return [
            'prices'     => $this->getPrices($filter),
            'attributes' => $this->getAttributes($filter),
        ];
    }

    /**
     * Диапазон цен из запроса
     *
     * @param array $filter
     *
     * @return int[]
     */
    private function getPrices(array $filter): array
    {
        $prices = Arr::get($filter, 'prices', null);

        $range = [
            'min' => 0,
            'max' => 0,
        ];

        if (!$prices) {
            return $range;
        }

        $prices = explode('-', $prices);

        if (count($prices) !== 2) {
            return $range;
        }

        $range['min'] = (int)$prices[0];
        $range['max'] = (int)$prices[1];

        return $range;
    }

    /**
     * Атрибуты фильтрации из запроса
     *
     * @param array $filter
     *
     * @return array
     */
    private function getAttributes(array $filter): array
    {
        $attributes = Arr::get($filter, 'attributes', null);

        return $attributes ? explode(',', $attributes) : [];
    }

    /**
     * Сортировка
     *
     * @param array $request
     *
     * @return array
     */
    private function getSortableColumns(array $request): array
    {
        $sort = Arr::get($request, 'sort', '{"views":"desc"}');
        $sort = json_decode($sort, true);

        $key = array_keys($sort)[0];

        return [
            'column'    => $key,
            'direction' => $sort[$key],
        ];
    }

    /**
     * Категории-потомки
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
     * Получить атрибуты фильтров текущей категории
     *
     * @param Category $category
     *
     * @return Collection
     */
    private function getFilterAttrOfCatalog(Category $category): Collection
    {
        return $category
            ->attributesWithValues()
            ->where('is_filter', true)
            ->get();
    }
}