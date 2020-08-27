<?php

namespace App\Http\Controllers\Dashboard\Partnership;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function index()
    {
        return  view('dashboard.partnership.index');
    }
}
