<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Запомнить партнера
     *
     * @param Request $request
     * @param string  $partnerToken
     *
     * @return RedirectResponse
     * @author Anton Reviakin
     */
    public function rememberPartnerToken(string $partnerToken = ''): RedirectResponse
    {
        if (!empty($partnerToken)) {
            Session::put('partner', $partnerToken);
            Cookie::queue('partner', $partnerToken, (60 * 24 * 365), '/', null, null, false);
        }

        return redirect()->route('front_index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone'    => ['required', 'regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}/'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $partnerId = null;

        //Получить токен партнера
        $partnerToken = Session::get('partner') ?? Cookie::get('partner');

        //Найти партнера по токену
        if ($partnerToken) {
            $partner = app(UserRepository::class)->getPartnerByToken($partnerToken);

            if ($partner) {
                $partnerId = $partner->id;
            }
        }

        return User::create([
            'partner_id' => $partnerId,
            'phone'      => $data['phone'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        return view('auth.register');
    }
}
