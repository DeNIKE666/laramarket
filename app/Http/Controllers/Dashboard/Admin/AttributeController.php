<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\AttributeRepository;
use App\Models\Category;
use App\Traits\UniqueModelSlug;
use App\Models\Attribute;

class AttributeController extends Controller
{
    use UniqueModelSlug;

    protected $adminAttributeRepository;

    public function __construct(
        AttributeRepository $adminAttributeRepository
    )
    {
        $this->adminAttributeRepository = $adminAttributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->adminAttributeRepository->listAttributes();
        //dump($attributes);
        return  view('dashboard.admin.attributes.index', compact('attributes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getAllCategory();
        return view('dashboard.admin.attributes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $data = [
            'name' => $request['name'],
            'slug' => $this->generateSlug(
                    Attribute::class,
                        $request['name']
                    ),
            'is_filter' => $request['is_filter'] ? $request['is_filter'] : 0
        ];

        $attribute = Attribute::create($data);
        if($request->input('categories')) {
            $attribute->categories()->attach($request->input('categories'));
        }

        return redirect()->route('admin.attributes.index');
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
    public function edit(Attribute $attribute)
    {
        $categories = Category::getAllCategory();
        return view('dashboard.admin.attributes.edit', compact('categories', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $data = [
            'name' => $request['name'],
            'is_filter' => $request['is_filter'] ? $request['is_filter'] : 0
        ];

        $attribute->update($data);

        $attribute->categories()->detach();
        if($request->input('categories')) {
            $attribute->categories()->attach($request->input('categories'));
        }

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
