<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Category;
use Gate;
use App\Traits\UniqueModelSlug;
use App\Models\ProductAttribute;

class ProductController extends Controller
{
    use UniqueModelSlug;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->paginate(20);
        //dump($products);
        return view('dashboard.shop.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getAllCategory();
        return view('dashboard.shop.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['attribute']);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'part_cashback' => 'required|integer',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'old_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'group_product' => 'required',
            //'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = [
                    'title' => $request['title'],
                    'category_id' => $request['category_id'],
                    'content' => $request['content'],
                    'price' => $request['price'],
                    'old_price' => $request['old_price'],
                    'group_product' => $request['group_product'],
                    'brand' => $request['brand'],
                    'part_cashback' => $request['part_cashback'],
                    'status' => Product::STATUS_PRODUCT_ACTIVE,
                    'user_id' => Auth::user()->id,
                    'slug' => $this->generateSlug(
                        Product::class,
                        $request['title']
                    )
                ];
        //dd($request['gallery']);
        $product = Product::create($data);


        if (isset($request['attribute'])) {
            foreach ($request['attribute'] as $attribute_id=>$attribute_value) {
                if($attribute_value != '') {
                    $dataAttr = [
                        'product_id' => $product->id,
                        'attribute_id' => $attribute_id,
                        'value' => $attribute_value
                    ];
                    ProductAttribute::add($dataAttr);
                }
            }
        }

        if (isset($request['image'])) {
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if (isset($request['gallery'])) {
            /*
            foreach ($request->input('gallery', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gallery');
            }*/

            $fileAdders = $product->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }
        return redirect()->route('products.edit', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        abort_if(Gate::denies('update-post', $product), 403, 'Sorry, you are not an admin');
        $categories = Category::getAllCategory();
        $gallery = [];
        if ($product->getGallery()) {
            foreach($product->getGallery() as $gal) {
                $src = ['thumbnail' => $gal->getUrl()];
                $gallery[] =  array_merge($gal->toArray(), $src);
            }
        }

        //dump($product->category->attributes);

        return view('dashboard.shop.product.edit', compact('categories', 'product', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        abort_if(Gate::denies('update-post', $product), 403, 'Sorry, you are not an admin');


        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'old_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'group_product' => 'required',
            //'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = [
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'content' => $request['content'],
            'price' => $request['price'],
            'old_price' => $request['old_price'],
            'group_product' => $request['group_product'],
            'brand' => $request['brand'],
            'status' => Product::STATUS_PRODUCT_ACTIVE,
        ];

        ProductAttribute::where('product_id', $product->id)->delete();
        if (isset($request['attribute'])) {
            foreach ($request['attribute'] as $attribute_id=>$attribute_value) {
                if($attribute_value != '') {
                    $dataAttr = [
                        'product_id' => $product->id,
                        'attribute_id' => $attribute_id,
                        'value' => $attribute_value
                    ];
                    ProductAttribute::add($dataAttr);
                }
            }
        }

        if (isset($request['image'])) {
            if ($product->getMedia('image')->first()) {
                $product->clearMediaCollection('image');
            }
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }
        if (isset($request['gallery'])) {
            $fileAdders = $product->addMultipleMediaFromRequest(['gallery'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('gallery');
            });
        }
        $product = $product->edit($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        abort_if(Gate::denies('update-post', $product), 403, 'Sorry, you are not an admin');
    }

    public function getAttributeProduct(Request $request) {
        $attributes = Category::findOrFail($request->input('category_id'))->attributes->all();

        if($request->input('id')) {
            $product = Product::findOrFail($request->input('id'));
            $productAttr = ProductAttribute::where('product_id', $product->id)->pluck('value', 'attribute_id');
        } else {
            $productAttr = [];
        }

        $returnHTML = view("dashboard.shop.product.attributes", compact('attributes', 'productAttr'))->render();
        $resArray = [
            'msg'=> "ok",
            'returnHTML' => $returnHTML,
            'attributes' => $attributes,
            'productAttr' => $productAttr
        ];
        return response()->json($resArray, 200);
    }
}
