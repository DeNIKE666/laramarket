<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item nav-category">
            <span class="nav-link">{{ __('messages.cabinet') }}</span>
        </li>
        <li class="nav-item {{ (request()->is(route('buyer.profile.edit'))) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buyer.profile.edit') }}">
                <span class="menu-title">{{ __('messages.my_profile') }}</span>
                <i class="icon-user menu-icon"></i>
            </a>
        </li>
        @can('is-buyer')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">
                    <span class="menu-title">{{ __('messages.purchase') }}</span>
                    <i class="icon-basket menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <span class="menu-title">{{ __('messages.cashback') }}</span>
                    <i class="icon-wallet menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <span class="menu-title">{{ __('messages.edit_score') }}</span>
                    <i class="icon-handbag menu-icon"></i>
                </a>
            </li>

        @endcan

        @can('is-partner')
            <li class="nav-item nav-category">
                <span class="nav-link">{{ __('messages.partner') }}</span>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="">
                    <span class="menu-title">{{ __('messages.partner_link') }}</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>
        @endcan

        @can('is-seller')
            <li class="nav-item nav-category">
                <span class="nav-link">{{ __('messages.shop') }}</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seller.products.index') }}">
                    <span class="menu-title">{{ __('messages.products') }}</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seller.order.list') }}">
                    <span class="menu-title">{{ __('messages.orders') }}</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
        @endcan

        @can('is-admin')
            <li class="nav-item ">
                <a class="nav-link {{ (request()->is(route('admin.users'))) ? 'active' : '' }}" href="{{ route('admin.users') }}">
                    <span class="menu-title">{{ __('messages.users') }}</span>
                    <i class="icon-people menu-icon"></i>
                </a>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">Настройки</span>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ (request()->is(route('admin.settings.index'))) ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <span class="menu-title">Настройки</span>
                    <i class="icon-people menu-icon"></i>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ (request()->is(route('admin.setting_schedules.index'))) ? 'active' : '' }}" href="{{ route('admin.setting_schedules.index') }}">
                    <span class="menu-title">График выплат</span>
                    <i class="icon-people menu-icon"></i>
                </a>
            </li>
        <!--shop admin nav-->
            <li class="nav-item nav-category">
                <span class="nav-link">{{ __('messages.shop') }}</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('seller.categories.index') }}">
                    <span class="menu-title">{{ __('messages.categories') }}</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.orders') }}">
                    <span class="menu-title">{{ __('messages.orders') }}</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
        @endcan

        <li class="nav-item nav-category">
            <span class="nav-link">{{ __('messages.help') }}</span>
        </li>

        @can('is-seller')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.tasks.index') }}">
                    <span class="menu-title">{{ __('messages.help') }}</span>
                    <i class="icon-bubble menu-icon"></i>
                </a>
            </li>
        @endcan

        @can('is-buyer')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.tasks.index') }}">
                    <span class="menu-title">{{ __('messages.help') }}</span>
                    <i class="icon-bubble menu-icon"></i>
                </a>
            </li>
        @endcan


        @can('is-admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.tasks.index') }}">
                    <span class="menu-title">Обращения</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
        @endcan
    </ul>
</nav>
<!-- partial -->
