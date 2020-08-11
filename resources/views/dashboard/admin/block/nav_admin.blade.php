<div class="lcPageMenuNav">
    <a href="{{ route('admin.home') }}"
       class="{{ (request()->is('dashboard/admin/index')) ? 'active' : '' }}">
        Личные данные
    </a>
    <a href="{{ route('admin.users') }}"
       class="{{ (request()->is('dashboard/admin/users*')) ? 'active' : '' }}">
        Пользователи
    </a>
    <a href="{{ route('admin.orders') }}"
       class="{{ (request()->is('dashboard/admin/orders*')) ? 'active' : '' }}">
        Заказы
    </a>
    <a href="{{ route('categories.index') }}"
       class="{{ (request()->is('dashboard/categories*')) ? 'active' : '' }}">
        Категории
    </a>
</div>