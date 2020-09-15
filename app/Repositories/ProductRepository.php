<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository
{
    /** @var Product $model */
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Получить продукт по id
     *
     * @param int $id
     *
     * @return Product
     *
     * @author Anton Reviakin
     */
    public function getProductById(int $id): Product
    {
        return $this
            ->model
            ->query()
            ->where('id', $id)
            ->firstOrFail();

//        try {
//            return \Cache::remember('product_id_' . $id, 3600, function () use ($id) {
//                return $this->findOneOrFail($id);
//            });
//        } catch (ModelNotFoundException $e) {
//            throw new ModelNotFoundException($e);
//        }
    }

    /**
     * Обновить статусы товаров
     *
     * @param int    $userId
     * @param string $status
     * @param array  $ids
     *
     * @return int
     *
     * @author Anton Reviakin
     */
    public function changeStatusBatchByUser(int $userId, string $status, array $ids = []): int
    {
        $query = $this
            ->model
            ->query()
            ->where('user_id', $userId);

        //По определенным id
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }

        return $query->update(compact('status'));
    }

    /**
     * Удалить товары
     *
     * @param int   $userId
     * @param array $ids
     *
     * @return bool|mixed|null
     * @throws \Exception
     *
     * @author Anton Reviakin
     */
    public function destroyBatchByUser(int $userId, array $ids = []): ?bool
    {
        $query = $this
            ->model
            ->query()
            ->where('user_id', $userId);

        //По определенным id
        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }

        return $query->delete();
    }

    /**
     * @param array $params
     *
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {
        try {
            $collection = collect($params);

            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('status', 'featured'));

            $product = new Product($merge->all());

            $product->save();

            if ($collection->has('categories')) {
                $product->categories()->sync($params['categories']);
            }
            return $product;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function updateProduct(array $params)
    {
        $product = $this->getProductById($params['product_id']);

        $collection = collect($params)->except('_token');

        $featured = $collection->has('featured') ? 1 : 0;
        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status', 'featured'));

        $product->update($merge->all());

        if ($collection->has('categories')) {
            $product->categories()->sync($params['categories']);
        }

        return $product;
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $product = $this->getProductById($id);

        $product->delete();

        return $product;
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function findProductBySlug($slug)
    {
        return \Cache::remember('product_slug_' . $slug, 3600, function () use ($slug) {
            return Product::where('slug', $slug)->first();
        });
    }

    /**
     * Получить Builder для продуктов по категориям
     *
     * @param array $descendants
     *
     * @return Builder
     * @author Anton Reviakin
     */
    public function getProductsByCategoryBuilder(array $descendants): Builder
    {
        return $this
            ->model
            ->query()
            ->whereIn('category_id', $descendants);
    }

    /**
     * @return bool
     */
    public function hasCookieViews()
    {
        if (isset($_COOKIE[Product::COOKVIEWS])) {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function addCookieViews($id)
    {
        try {
            if ($this->hasCookieViews()) {
                $value = $_COOKIE[Product::COOKVIEWS];
                $arViews = explode("|", $value);

                if (($delete_key = array_search($id, $arViews)) !== false) {
                    unset($arViews[$delete_key]);
                }
                if (count($arViews) > 3) {
                    unset($arViews[4]);
                }
                array_unshift($arViews, $id);
                $newArViews = implode("|", $arViews);
                //dd($newArViews);
            } else {
                $newArViews = $id;
            }
            setcookie(Product::COOKVIEWS, $newArViews, time() + 3600, "/", "", 0);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getCookieViews()
    {
        if ($this->hasCookieViews()) {
            $value = $_COOKIE[Product::COOKVIEWS];
            return explode("|", $value);
        }
        return false;
    }
}