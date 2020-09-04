<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
use Auth;

class AuthController extends Controller
{

    /*public function loginForm()
    {
        return view('pages.login');
    }*/

    /**
     * @return mixed
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
