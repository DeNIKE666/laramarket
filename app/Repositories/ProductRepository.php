<?php
namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
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
     * @return mixed
     */
    public function updateProduct(array $params)
    {
        $product = $this->findProductById($params['product_id']);

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
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $product = $this->findProductById($id);

        $product->delete();

        return $product;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return $product;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getProductsByCategory(array $arParentCat)
    {
        $products = Product::whereIn('category_id', $arParentCat)->paginate(Product::PAGINATE);

        return $products;
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
            setcookie(Product::COOKVIEWS, $newArViews, time()+3600, "/","", 0);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }


}