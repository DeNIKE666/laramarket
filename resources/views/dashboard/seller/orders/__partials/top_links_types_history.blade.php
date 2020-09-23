@push('styles')
    <link href="{{ asset('css/dashboard/orders/details.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/dashboard/seller/orders/details.js') }}"></script>
@endpush

{{-- Модальное окно с детализацией заказа --}}
<div id="popup-orderDetails" class="popUp popUp-pay">
    <div class="popUp__content">
        <div class="popUp__title">
            Статус заказа
        </div>
        <div class="is-loading">
            Подождите, идет загрузка...
        </div>
        <div class="popUp__body" style="width: 100%;"></div>
    </div>
    <div class="popUp__layer"></div>
</div>

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