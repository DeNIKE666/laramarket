<div class="lcPageMenu">
    <div class="lcPageMenuTop">
        <div class="lcPageMenuTop__img">
            <img src="{{ asset('img/photos/18.png') }}" alt="">
        </div>
        <div class="lcPageMenuTop__name">
            {{ auth()->user()->getName() }}
        </div>
    </div>

    @cannot('role-admin')
        <div class="lcPageMenuNav">
            @if(request()->is('dashboard/buyer/*'))
                @include('dashboard.partials.nav_buyer')
            @endif
            @if(request()->is('dashboard/partner', 'dashboard/partner/*'))
                @include('dashboard.partials.nav_partner')
            @endif
            @if(request()->is('dashboard/shop/*'))
                @include('dashboard.partials.nav_seller')
            @endif
        </div>
        <div class="lcPageMenuCash">
            Баланс:
            <span>{{ auth()->user()->personal_account }} руб.</span>
        </div>

        @can('role-user')
            @if(auth()->user()->request_shop == 0)
                <a href="{{ route('application-to-seller') }}" class="btn lcPageMenu__btn">Стать продавцом</a>
            @else
                <p>Заявка на продовца отправлена скоро будет расмотренна</p>
            @endif
        @endcan
        @can('is-partner')
            {{
                Form::text(
                    '',
                    route('join', auth()->user()->partner_token),
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
            {{ Form::open(['route' => ['become-partner'], 'method' => 'patch']) }}
            {{ Form::submit(__('users/partner.become_partner'), ['class' => 'btn lcPageMenu__btn']) }}
            {{ Form::close() }}
        @endif

    @endcannot

    @can('role-admin')
        @include('dashboard.admin.block.nav_admin')
    @endcan

</div>
