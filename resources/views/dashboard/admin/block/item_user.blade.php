<tr>
    <td><a href="{{ route('admin.info_user', $user->id) }}">{{ $user->getName() }}</a></td>
    <td>{{ $user->getNameRole() }}</td>
    <td>
        @if($user->is_partner == 1)
            Да
        @else
            Нет
        @endif
    </td>
    <td>
        @if($user->request_shop == 1 && $user->role == \App\Models\User::ROLE_USER)
            <a class="btn btn-info btn-sm" href="">Подтвердить</a>
        @endif
    </td>
    <td>
        <a class="btn btn-info">Подробнее</a>
    </td>
</tr>

