<div class="lcPageMenuNav">
    <a href="{{ route('admin.home') }}"
       class="{{ (request()->is('dashboard/admin')) ? 'active' : '' }}">
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
    <a href="{{ route('admin.attributes.index') }}"
       class="{{ (request()->is('dashboard/admin/attributes*')) ? 'active' : '' }}">
        Характеристики
    </a>
    <a href="{{ route('admin.payment_option.index') }}"
       class="{{ (request()->is('dashboard/admin/payment_option*')) ? 'active' : '' }}">
        Платёжная система
    </a>
    <a href="{{ route('admin.page.index') }}"
       class="{{ (request()->is('dashboard/admin/page*')) ? 'active' : '' }}">
        Текстовые страницы
    </a>
    <a href="{{ route('admin.tasks') }}"
       class="{{ (request()->segment(3) == 'tasks') ? 'active' : '' }}">
        Техподдержка
    </a>
</div>