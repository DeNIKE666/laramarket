<div class="lcPageContentTop">

    @cannot('role-admin')
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
            <a href="{{ route('partner.index') }}"
                class="lcPageContentTop__btn {{ request()->is('dashboard/partner', 'dashboard/partner/*') ? 'lcPageContentTop__btn-active btn-blue' : null }}">
                Кабинет партнёра
            </a>
        @endcan

    @endcannot

    @can('role-admin')
        <a
            href="{{ route('admin.home') }}"
            class="lcPageContentTop__btn {{ request()->is('dashboard/admin/*') ? 'lcPageContentTop__btn-active btn-blue' : null }}">
            Кабинет администратора
        </a>
    @endcan
</div>