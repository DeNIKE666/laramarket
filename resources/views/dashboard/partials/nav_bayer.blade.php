<a href="{{ route('adminIndex') }}"
   class="{{ (request()->is('dashboard/buyer/index')) ? 'active' : '' }}">
    Личные данные
</a>
<a href="{{ route('user_orders_list') }}"
   class="{{ (request()->is('dashboard/buyer/orders*')) ? 'active' : '' }}">
    Мои заказы
</a>
<a href="{{ route('user_history_order') }}"
   class="{{ (request()->is('dashboard/buyer/history_orders*')) ? 'active' : '' }}">
    История заказов
</a>
<a href="{{ route('user_list_cashback') }}"
   class="{{ (request()->is('dashboard/buyer/list_cashback*')) ? 'active' : '' }}">
    Кэшбэк
</a>
<a href="{{ route('user_pay') }}"
   class="{{ (request()->is('dashboard/buyer/user_pay*')) ? 'active' : '' }}">
    Пополнение/снятие
</a>
<a href="{{ route('tasks.index') }}"
   class="{{ (request()->is('dashboard/buyer/tasks*')) ? 'active' : '' }}">
    Помощь
</a>