@extends('layouts.admin')

@section('content')
    <div class="lcPageContentTable">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                Имя
            </div>
            <div class="lcPageContentCol">
                Роль
            </div>
            <div class="lcPageContentCol">
                Партнер
            </div>
            <div class="lcPageContentCol">
                Запрос на продавца
            </div>
        </div>
        @each('dashboard.admin.block.item_user', $users, 'user')
        {{ $users->links() }}
    </div>
@endsection
