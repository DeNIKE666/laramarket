<div class="lcPageContentRow">
    <div class="lcPageContentCol">
        <a href="{{ route('admin.info_user', $user->id) }}">{{ $user->getName() }}</a>
    </div>
    <div class="lcPageContentCol">
        {{ $user->getNameRole() }}
    </div>
    <div class="lcPageContentCol">
        @if($user->is_partner == 1)
            Да
        @else
            Нет
        @endif
    </div>
    <div class="lcPageContentCol">
        @if($user->request_shop == 1 && $user->role == \App\Models\User::ROLE_USER)
            {{ Form::open(['route' => ['admin.approved_seller'], 'method' => 'put', 'class' => 'forms-sample']) }}
            {{ Form::hidden('user_id', $user->id) }}
            <button type="submit" class="lcPageContentSort__btn btn">Подтвердить</button>
            {{ Form::close() }}
        @endif
    </div>
</div>