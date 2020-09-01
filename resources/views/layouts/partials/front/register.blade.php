<div class="popUp popUp-reg">
    <div class="popUp__content">
        <div class="popUp__title">
            Регистрация
        </div>
        <form
                method="POST"
                action="{{ route('register') }}"
                id="registerForm"
                data-success="{{ route('edit-profile') }}"
        >
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
                <label class="catalogFilter__check check-inp" for="oferta">
                    <input type="checkbox" name="oferta" id="ofertaInput" checked required>
                    <span>
                        Согласен с условиями Публичной оферты
                    </span>
                </label>
                <span class="invalid-feedback"  id="ofertaError"></span>
            </div>
            <button class="popUp__btn btn btn-center">
                Зарегистрироваться
            </button>
        </form>
    </div>
    <div class="popUp__layer">

    </div>
</div>
