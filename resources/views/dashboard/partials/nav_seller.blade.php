<a href="{{ route('seller_status') }}"
   class="{{ (request()->is('dashboard/shop/index')) ? 'active' : '' }}">
    Панель состояния
</a>
<a href="{{ route('products.index') }}"
   class="{{ (request()->is('dashboard/shop/products*')) ? 'active' : '' }}">
    Мои товары
</a>
<a href="">
    Мои продажи
</a>
<a href="">
    Данные продавца
</a>
<a href="{{ route('tasks.index') }}"
   class="{{ (request()->is('dashboard/buyer/tasks*')) ? 'active' : '' }}">
    Помощь
</a>