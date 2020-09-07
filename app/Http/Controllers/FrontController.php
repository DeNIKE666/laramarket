<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kalnoy\Nestedset\DescendantsRelation;


class FrontController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(): View
    {
        $products_popular = Product::getProductsById(Product::getPopularProductById());
        //dd(Product::ViewsId());
        $products_views = Product::getProductsById(Product::ViewsId());
        //$products_views = [];
        return view('front.page.home', compact('products_views', 'products_popular'));
    }

    /**
     * О компании
     *
     * @return View
     */
    public function about(): View
    {
        return view('front.page.about');
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
        foreach ($product->productAttributes()->get() as $productAttr) {
            //dump($productAttr->attribute->name);
            $arDataProductAttr[] = [
                'name'  => $productAttr->attribute->name,
                'value' => $productAttr->value,
            ];
        }

        return view('front.page.product', compact('product', 'products_views', 'arDataProductAttr'));
    }

    public function pageStatic($slug)
    {
        try {
            $page = Page::SlugPage($slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return abort(404);
        }
        return view('front.page.static_page', compact('page'));
    }

}
