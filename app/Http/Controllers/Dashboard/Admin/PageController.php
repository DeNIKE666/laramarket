<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PageFormRequest;
use App\Traits\UniqueModelSlug;

class PageController extends Controller
{
    use UniqueModelSlug;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return  view('dashboard.admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('dashboard.admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PageFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageFormRequest $request)
    {

        $data = [
            'name' => $request['name'],
            'slug' => $this->generateSlug(
                Page::class,
                $request['name']
            ),
            'content' => $request['content'],
        ];

        $page = Page::create($data);

        return redirect()->route('admin.page.index');
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
    public function edit(Page $page)
    {
        return view('dashboard.admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PageFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageFormRequest $request, Page $page)
    {

        $data = [
            'name' => $request['name'],
            'slug' => $request['slug'],
            'content' => $request['content']
        ];

        $page->update($data);

        return redirect()->route('admin.page.index');
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
