<div class="popUp popUp-reg">
    <div class="popUp__content">
        <div class="popUp__title">
            Регистрация
        </div>
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <input type="tel"
                   class="popUp__inp"
                   placeholder="Телефон"
                   name="phone"
                   value="{{ old('phone') }}"
                   required
                   id="phoneInput"
            >
            <span class="invalid-feedback"  id="phoneError"></span>
            <input type="email"
                   class="popUp__inp"
                   placeholder="E-mail"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   id="emailInput"
            >
            <span class="invalid-feedback"  id="emailError"></span>
            <input
                    type="password"
                    class="popUp__inp"
                    placeholder="Пароль"
                    name="password"
                    id="passwordInput"
                    required
            >
            <span class="invalid-feedback"  id="passwordError"></span>
            <input
                    id="password-confirm"
                    type="password"
                    class="popUp__inp"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('messages.confirm_password') }}"
            >

            <div class="popUp__check">
                <label class="catalogFilter__check">

                    <div>
                        <!--svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="7px" height="6px">
                            <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                  d="M3.167,5.724 C2.849,6.088 2.334,6.088 2.017,5.724 L0.235,3.676 C-0.083,3.311 -0.083,2.719 0.235,2.354 C0.552,1.989 1.067,1.989 1.385,2.354 L2.447,3.574 C2.527,3.666 2.657,3.666 2.737,3.574 L5.612,0.270 C5.930,-0.094 6.445,-0.094 6.762,0.270 C6.915,0.446 7.000,0.684 7.000,0.931 C7.000,1.179 6.915,1.417 6.762,1.592 L3.167,5.724 Z"/>
                        </svg-->
                        <input type="checkbox" name="oferta" id="ofertaInput" checked required>
                    </div>
                    <span>
                        Согласен с условиями Публичной оферты
                    </span>
                </label>
                <span class="invalid-feedback"  id="ofertaError"></span>
            </div>
            <button class="popUp__btn btn">
                Зарегистрироваться
            </button>
        </form>
    </div>
    <div class="popUp__layer">

    </div>
</div>
