@push('styles')
    <link href="{{ asset('css/dashboard/orders/details.css') }}" rel="stylesheet">
@endpush

<div class="lcPageContentPayChoose">
    <a href="{{ route('seller.order.list.in_progress') }}"
       class="lcPageContentPayChoose__item
       @if(request()->is('dashboard/seller/order/list/in-progress')) lcPageContentPayChoose__item-active @endif"
    >
        <div class="lcPageContentPayChoose__check">
            <span></span>
        </div>
        <span>@lang('seller/orders/history.types.in_progress')</span>
    </a>

    <a href="{{ route('seller.order.list.in-archive') }}"
       class="lcPageContentPayChoose__item
       @if(request()->is('dashboard/seller/order/list/in-archive')) lcPageContentPayChoose__item-active @endif"
    >
        <div class="lcPageContentPayChoose__check">
            <span></span>
        </div>
        <span>@lang('seller/orders/history.types.in_archive')</span>
    </a>
</div>