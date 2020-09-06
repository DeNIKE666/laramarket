<?php

namespace App\Http\Controllers\Dashboard\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Kalnoy\Nestedset\NodeTrait;
use App\Traits\UniqueModelSlug;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    use NodeTrait;
    use UniqueModelSlug;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('is-admin')) {
            $categories = Category::getAllCategory();

            return view('dashboard.shop.categories.index', compact('categories'));
        } else {
            return redirect()->route('buyer.profile.edit')->with('status', 'Доступ для админа');
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
                'slug' => $this->generateSlug(
                    Category::class,
                    $request['title']
                )
                //'slug' => Str::of($request['title'])->slug('-')->__toString()
            ],
            Category::getStatusUser()
        );

        $category = Category::create($data);
        Cache::forget('getAllCategory');
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
            'slug' => 'required|string|max:255',
        ]);

        $category->update([
            'title' => $request['title'],
            'parent_id' => $request['parent'],
            'content' => $request['content'],
            'slug' => $request['slug']
        ]);
        Cache::forget('getAllCategory');
        return redirect()->back()->with('status', 'Категория обновлена');
    }

    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }
        Cache::forget('getAllCategory');
        return redirect()->route('categories.index');
    }

    public function up(Category $category)
    {
        $category->up();
        Cache::forget('getAllCategory');
        return redirect()->route('categories.index');
    }

    public function down(Category $category)
    {
        $category->down();
        Cache::forget('getAllCategory');
        return redirect()->route('categories.index');
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }
        Cache::forget('getAllCategory');
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        if (Gate::allows('is-admin')) {
            $category->delete();
        }
        Cache::forget('getAllCategory');
        return redirect()->route('categories.index');
    }
}
