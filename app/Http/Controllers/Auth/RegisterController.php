<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RegisterController extends Controller
{
    use RegistersUsers;

    private $userRepository;

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
        $this->userRepository = app(UserRepository::class);
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
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $partner = $this->detectPartner();

        return User::create([
            'partner_id' => $partner->id,
            'phone'      => $data['phone'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
        ]);
    }

    /**
     * Найти партнера
     *
     * @return User|null
     */
    private function detectPartner(): ?User
    {
        //Получить токен партнера из сессии или куки
        $partnerToken = Session::get('partner') ?: Cookie::get('partner');

        if (!$partnerToken) {
            return null;
        }

        //Найти партнера по токену
        return $this->userRepository->getPartnerByToken($partnerToken);
    }

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm(Request $request): View
    {
        return view('auth.register');
    }
}
