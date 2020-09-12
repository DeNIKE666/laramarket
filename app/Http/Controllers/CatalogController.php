<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /** @var CatalogService $catalogService */
    private $catalogService;

    public function __construct()
    {
        $this->catalogService = app(CatalogService::class);
    }

    /**
     * Каталог
     *
     * @param Request $request
     * @param string  $slug
     *
     * @return View
     */
    public function index(Request $request, string $slug): View
    {
        $catalog = $this
            ->catalogService
            ->getCatalogWithFilters(
                $request->input(),
                $slug
            );

        return view('front.page.catalog', compact('catalog'));
    }
}
