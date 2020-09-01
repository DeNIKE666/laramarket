<a href="{{ route('seller_status') }}"
   class="{{ (request()->is('dashboard/shop')) ? 'active' : '' }}">
    Панель состояния
</a>
<a href="{{ route('products.index') }}"
   class="{{ (request()->is('dashboard/shop/products*')) ? 'active' : '' }}">
    Мои товары
</a>
<a href="{{ route('order.list') }}"
   class="{{ (request()->is('dashboard/shop/order*')) ? 'active' : '' }}">
    Мои продажи
</a>
<a href="{{ route('data_sellers') }}">
    Данные продавца
</a>
<a href="{{ route('tasks.index') }}"
   class="{{ (request()->is('dashboard/buyer/tasks*')) ? 'active' : '' }}">
    Помощь
</a>