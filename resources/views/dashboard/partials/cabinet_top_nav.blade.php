@php
    //КОСТЫЛЬ ИЗ-ЗА ВЕРСТКИ. ЧТОБ СВЕРХУ НЕ БЫЛО ОТСТУПА

    /** @var \App\Models\User $user */
    $user = auth()->user();

    $margin = '';

    if ($user->isAdmin()) {
        $margin = 'style="margin: 0;"';
    }
@endphp

<div class="lcPageContentTop" {!! $margin !!}>

    @cannot('role-admin')
        <a href="{{ route('edit-profile') }}"
           class="lcPageContentTop__btn {{ request()->is('dashboard/buyer', 'dashboard/buyer/*') ? 'lcPageContentTop__btn-active btn-blue' : null }} ">
            Кабинет покупателя
        </a>

        @can('role-shop')
            <a href="{{ route('seller_status') }}"
               class="lcPageContentTop__btn {{ request()->is('dashboard/shop', 'dashboard/shop/*') ? 'lcPageContentTop__btn-active btn-blue' : null }} ">
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

    {{--    @can('role-admin')--}}
    {{--        <a class="lcPageContentTop__btn {{ request()->is('dashboard/admin/*') ? 'lcPageContentTop__btn-active btn-blue' : null }}">--}}
    {{--            Кабинет администратора--}}
    {{--        </a>--}}
    {{--    @endcan--}}
</div>