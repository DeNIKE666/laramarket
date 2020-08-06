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
        return view('home');
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
        $this->productRepository->addCookieViews($product->id);
        return view('front.page.product', compact('product'));
    }


}
