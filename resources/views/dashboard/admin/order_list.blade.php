@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Список заказаов
        </div>

        <div class="lcPageContentTable">
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    #
                </div>
                <div class="lcPageContentCol">
                    Сумма
                </div>
                <div class="lcPageContentCol">
                    Статус
                </div>
                <div class="lcPageContentCol">
                    Дата
                </div>
                <div class="lcPageContentCol">
                </div>
            </div>
            @each('dashboard.admin.block.item_order', $orders, 'order')
        </div>
        {{ $orders->links() }}

    </div>
@endsection
