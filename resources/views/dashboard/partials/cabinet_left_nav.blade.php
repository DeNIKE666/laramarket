@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

<div class="lcPageMenu">
    <div class="lcPageMenuTop">
        <div class="lcPageMenuTop__img">
            <img src="{{ asset('img/photos/18.png') }}" alt="">
        </div>
        <div class="lcPageMenuTop__name">
            {{ getName($user) }}
        </div>
    </div>

    @cannot('is-admin')
        <div class="lcPageMenuNav">
            @if(request()->is('dashboard/user', 'dashboard/buyer', 'dashboard/buyer/*', 'dashboard/user/tasks*'))
                @include('dashboard.partials.nav_buyer')
            @endif
            @if(request()->is('dashboard/partner', 'dashboard/partner/*'))
                @include('dashboard.partials.nav_partner')
            @endif
            @if(request()->is('dashboard/seller', 'dashboard/seller/*'))
                @include('dashboard.partials.nav_seller')
            @endif
        </div>
        <div class="lcPageMenuCash">
            Баланс:
            <span>{!! formatByCurrency($user->personal_account, 2) !!}</span>
        </div>

        @can('is-buyer')
            @if(!$user->hasSellerRequest())
                <a href="{{ route('user.application-to-seller') }}" class="btn lcPageMenu__btn">Стать продавцом</a>
            @else
                <p>Заявка на продовца отправлена скоро будет расмотренна</p>
            @endif
        @endcan
        @can('is-partner')
            {{
                Form::text(
                    '',
                    route('join', $user->partner_token),
                    [
                        'id'    => 'partner-link',
                        'style' => 'position: absolute; left: -100em;'
                    ]
                )
            }}

            {{
                Form::button(
                    __('users/partner.copy_link'),
                    ['class' => 'btn lcPageMenu__btn copy-partner-link']
                )
            }}
        @else
            {{ Form::open(['route' => ['user.become-partner'], 'method' => 'patch']) }}
            {{ Form::submit(__('users/partner.become_partner'), ['class' => 'btn lcPageMenu__btn']) }}
            {{ Form::close() }}
        @endif

    @endcannot

    @can('is-admin')
        @include('dashboard.admin.block.nav_admin')
    @endcan

</div>
