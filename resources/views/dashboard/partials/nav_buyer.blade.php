<a href="{{ route('buyer.profile.edit') }}"
   class="{{ (request()->is('dashboard/buyer')) ? 'active' : '' }}">
    Личные данные
</a>
<a href="{{ route('buyer.orders') }}"
   class="{{ (request()->is('dashboard/buyer/orders*')) ? 'active' : '' }}">
    Мои заказы
</a>
<a href="{{ route('buyer.orders.archive') }}"
   class="{{ (request()->is('dashboard/buyer/history_orders*')) ? 'active' : '' }}">
    История заказов
</a>
<a href="{{ route('buyer.cashback.index') }}"
   class="{{ (request()->is('dashboard/buyer/cashback*')) ? 'active' : '' }}">
    Кэшбэк
</a>
<a href="{{ route('buyer.finance.deposit_withdraw') }}"
   class="{{ (request()->is('dashboard/buyer/finance/deposit-withdraw')) ? 'active' : '' }}">
    Пополнение/снятие
</a>
<a href="{{ route('user.tasks.index') }}"
   class="{{ (request()->segment(3) == 'tasks') ? 'active' : '' }}">
    Помощь
</a>