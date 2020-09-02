<a href="{{ route('partner.index') }}" class="{{ (request()->is('dashboard/partner')) ? 'active' : '' }}">
    Аккаунт
</a>

<a href="{{ route('partner.referrals') }}" class="{{ (request()->is('dashboard/partner/referrals*')) ? 'active' : '' }}">
    Мои рефералы
</a>

<a href="{{ route('partner.history-account') }}" class="{{ (request()->is('dashboard/partner/history-account*')) ? 'active' : '' }}">
    История начислений
</a>