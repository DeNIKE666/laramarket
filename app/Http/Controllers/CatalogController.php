<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /** @var CatalogService $catalogService */
    private $catalogService;

    public function __construct()
    {
        $this->catalogService = app(CatalogService::class);
    }

    public function index(Request $request, string $slug)
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
