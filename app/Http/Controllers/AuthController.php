<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Region;
use Mail;

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
