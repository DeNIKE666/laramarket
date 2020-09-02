@php
    /** @var \App\Models\User $user */
@endphp

<div class="lcPageContentRow">
    <div class="lcPageContentCol">
        <a href="{{ route('admin.info_user', $user->id) }}">{{ getName($user) }}</a>
    </div>
    <div class="lcPageContentCol">
        @lang('users/roles.' . $user->role)
    </div>
    <div class="lcPageContentCol">
        @if($user->isPartner())
            @lang('users/partner.is_partner')
        @else
            @lang('users/partner.is_not_partner')
        @endif
    </div>
    <div class="lcPageContentCol">
        @if($user->request_shop == 1)
            {{ Form::open(['route' => ['admin.approve-as-seller'], 'method' => 'put', 'class' => 'forms-sample']) }}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::submit(__('admin/users.confirm'), ['class' => 'lcPageContentSort__btn btn']) }}
            {{ Form::close() }}
        @endif
    </div>
</div>