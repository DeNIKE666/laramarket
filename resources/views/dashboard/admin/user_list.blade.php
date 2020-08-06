@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Список пользователей</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Роль</th>
                            <th>Партнер</th>
                            <th>Запрос на продавца</th>
                        </tr>
                        </thead>
                        <tbody>
                            @each('dashboard.admin.block.item_user', $users, 'user')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
