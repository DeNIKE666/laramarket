<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Category;
use Gate;

class ProductController extends Controller
{
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
        //dump($request['image']);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'group_product' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = [
                    'title' => $request['title'],
                    'category_id' => $request['category_id'],
                    'content' => $request['content'],
                    'price' => $request['price'],
                    'old_price' => $request['old_price'],
                    'group_product' => $request['group_product'],
                    'status' => Product::STATUS_PRODUCT_ACTIVE,
                    'user_id' => Auth::user()->id,
                ];
        //dd($request['image']);
        $product = Product::create($data);

        if (isset($request['image'])) {
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if (isset($request['gallery'])) {
            foreach ($request->input('gallery', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('gallery');
            }
        }
        return redirect()->route('products.index')->with('status', 'товар добавлен');
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
                $src = ['thumbnail' => 'http://market.myfbr.ru/' . $gal->getUrl()];
                $gallery[] =  array_merge($gal->toArray(), $src);
            }
        }

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
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'group_product' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = [
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'content' => $request['content'],
            'price' => $request['price'],
            'old_price' => $request['old_price'],
            'group_product' => $request['group_product'],
            'status' => Product::STATUS_PRODUCT_ACTIVE,
        ];
        if (isset($request['image'])) {
            if ($product->getMedia('image')->first()) {
                $product->clearMediaCollection('image');
            }
            $product->addMediaFromRequest('image')->toMediaCollection('image');

        }
        $product = $product->edit($data);

        return redirect()->back()->with('status', 'товар обновлен');
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
}
