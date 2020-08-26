<?php
namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\ProductAttribute;

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
            return \Cache::remember('product_id_' . $id, 3600, function() use ($id) {
                return $this->findOneOrFail($id);
            });
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
        return \Cache::remember('product_slug_' . $slug, 3600, function() use ($slug) {
            return Product::where('slug', $slug)->first();
        });
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getProductsByCategory(array $arParentCat)
    {
        $products = Product::whereIn('category_id', $arParentCat)->active();
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

    /**
     * @param $id
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

    public function getFilterChekbox($catFilter, $arFilterChek, $arIdProduct)
    {

        $filterProps = [];
        if($catFilter->count() > 0) {
            foreach ($catFilter as $attribute) {
                //dump($attribute->name);

                $listAttr = ProductAttribute::whereIn('product_id', $arIdProduct)
                    ->where('attribute_id', $attribute->id)
                    //->pluck('value')
                    ->get('value')
                    ->unique('value')
                    ->toArray();
                //dump($listAttr);
                if (count($listAttr) > 0) {
                    $listAttrFull = [];
                    foreach ($listAttr as $attr) {
                        $status = 0;
                        if (isset($arFilterChek[$attribute->id]) && in_array($attr['value'], $arFilterChek[$attribute->id])) {
                            $status = 1;
                        }
                        $listAttrFull[] = [
                            'value' =>  $attr['value'],
                            'status' => $status
                        ];
                    }
                    $filterProps[$attribute->id] = [
                        'name' => $attribute->name,
                        'list' => $listAttrFull
                    ];
                }
            }
        }
        return $filterProps;
    }



}