<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Kalnoy\Nestedset\NodeTrait;

class CategoryController extends Controller
{
    use NodeTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('role-admin')) {
            $categories = Category::getAllCategory();

            return view('dashboard.shop.categories.index', compact('categories'));
        } else {
            return redirect()->route('adminIndex')->with('status', 'Доступ для админа');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::getAllCategory();
        return view('dashboard.shop.categories.create', compact('parents'));
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
            'title' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
        ]);

        $data = array_merge(
            [
                'title' => $request['title'],
                'parent_id' => $request['parent'],
                'content' => $request['content'],
            ],
            Category::getStatusUser()
        );

        //dd($data);

        $category = Category::create($data);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.shop.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->where('id', '!=', $category->id)->get();
        return view('dashboard.shop.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
        ]);

        $category->update([
            'title' => $request['title'],
            'parent_id' => $request['parent'],
        ]);

        return redirect()->back()->with('status', 'Категория обновлена');
    }

    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }

        return redirect()->route('categories.index');
    }

    public function up(Category $category)
    {
        $category->up();

        return redirect()->route('categories.index');
    }

    public function down(Category $category)
    {
        $category->down();

        return redirect()->route('categories.index');
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        //$category->delete();

        return redirect()->route('categories.index');
    }
}
