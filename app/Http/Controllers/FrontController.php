<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cookie;


class FrontController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products_popular = Product::getProductsById(Product::getPopularProductById());
        //dd(Product::ViewsId());
        $products_views = Product::getProductsById(Product::ViewsId());
        //$products_views = [];
        return view('front.page.home', compact('products_views', 'products_popular'));
    }

    public function catalog($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $arParentCat = $category->descendants()->defaultOrder()->pluck('id')->toArray();
        $arParentCat[] = $category->id;

        $products = $this->productRepository->getProductsByCategory($arParentCat);

        return view('front.page.catalog', compact('category', 'products'));
    }

    public function product($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        if (!$this->productRepository->hasCookieViews()) {
            event('productHasViewed', $product);
        }
        $products_views = Product::getProductsById(Product::ViewsId());
        $this->productRepository->addCookieViews($product->id);
        $arDataProductAttr = [];
        foreach($product->product_attributes()->get() as $productAttr) {
            //dump($productAttr->attribute->name);
            $arDataProductAttr[] = [
                'name' => $productAttr->attribute->name,
                'value' => $productAttr->value
            ];
        }

        return view('front.page.product', compact('product', 'products_views', 'arDataProductAttr'));
    }


}
