<div class="lcPageContentTop">

    <a href="{{ route('adminIndex') }}"
       class="lcPageContentTop__btn {{ request()->is('dashboard/buyer/*') ? 'lcPageContentTop__btn-active btn-blue' : null }} ">
        Кабинет покупателя
    </a>

    @can('role-shop')
    <a href="{{ route('seller_status') }}"
       class="lcPageContentTop__btn {{ request()->is('dashboard/shop/*') ? 'lcPageContentTop__btn-active btn-blue' : null }} ">
        Кабинет продавца
    </a>
    @endcan
    @can('is-partner')
    <a class="lcPageContentTop__btn">
        Кабинет партнёра
    </a>
    @endcan
</div>