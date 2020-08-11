<div class="popUp popUp-auth">
    <div class="popUp__content">
        <div class="popUp__title">
            Авторизация
        </div>
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <input
                    type="email"
                    id="emailInput2"
                    name="email"
                    class="popUp__inp"
                    placeholder="E-mail"
                    value="{{ old('email') }}"
                    required
            >
            <span class="invalid-feedback" id="emailError2"></span>
            <input
                    type="password"
                    class="popUp__inp"
                    placeholder="Пароль"
                    required
                    name="password"
                    id="passwordInput2"
            >
            <span class="invalid-feedback" id="passwordError2"></span>

            <button class="popUp__btn btn btn-center">
                Войти
            </button>
            <div class="form-center__footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-primary">
                    Забыли пароль
                </a>
            @endif
            </div>
        </form>
    </div>
    <div class="popUp__layer">

    </div>
</div>