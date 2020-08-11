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
            <a class="btn btn-info btn-sm" href="">Подтвердить</a>
        @endif
    </div>
</div>