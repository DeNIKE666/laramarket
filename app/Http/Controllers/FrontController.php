<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;


class FrontController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index():View
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
    public function about():View
    {
        return view('front.page.about');
    }

    public function catalog(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $arParentCat = $category->descendants()->defaultOrder()->pluck('id')->toArray();
        $arParentCat[] = $category->id;

        $filterAttributes = $request->has('attr') ? $request->get('attr') : [];

        $attrChecks = array_values($filterAttributes ?: []);


        $products = $this
            ->productRepository
            ->getProductsByCategory(
                $arParentCat,
                $filterAttributes
            );


        $minPrice = $request->get('min_price') ?: (int)$products->min('price');
        $maxPrice = $request->get('max_price') ?: (int)$products->max('price');

        $catFilter = $category->attributes()->where('is_filter', 1)->get();

        $products = $products->wherein('price' , [$minPrice, $maxPrice])->paginate(Product::PAGINATE);


        return view('front.page.catalog',
            compact(
                'category',
                'products',
                'catFilter',
                'maxPrice',
                'minPrice',
                'attrChecks'
            )
        );
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
        foreach ($product->product_attributes()->get() as $productAttr) {
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
