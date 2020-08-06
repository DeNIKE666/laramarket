@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Список заказаов</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('dashboard.admin.block.item_order', $orders, 'order')
                        </tbody>
                    </table>
                    <hr>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
