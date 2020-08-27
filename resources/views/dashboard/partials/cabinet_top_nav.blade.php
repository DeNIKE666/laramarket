<div class="lcPageContentTop">

    @cannot('role-admin')
    <a href="{{ route('adminIndex') }}"
       class="lcPageContentTop__btn {{ request()->is('dashboard/buyer/*') ? 'lcPageContentTop__btn-active btn-blue' : null }} ">
        Кабинет покупателя
    </a>
    @endcannot

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

    @can('role-admin')
        <a href="{{ route('admin.home') }}" class="lcPageContentTop__btn {{ request()->is('dashboard/admin/*') ? 'lcPageContentTop__btn-active btn-blue' : null }}">
            Кабинет администратора
        </a>
    @endcan
</div>