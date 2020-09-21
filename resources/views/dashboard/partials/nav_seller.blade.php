<a href="{{ route('seller.seller_status') }}"
   class="{{ (request()->is('dashboard/seller')) ? 'active' : '' }}">
    Панель состояния
</a>
<a href="{{ route('seller.products.index') }}"
   class="{{ (request()->is('dashboard/seller/products*')) ? 'active' : '' }}">
    Мои товары
</a>
<a href="{{ route('seller.order.list') }}"
   class="{{ (request()->is('dashboard/seller/order*')) ? 'active' : '' }}">
    Мои продажи
</a>
<a href="{{ route('seller.data_sellers') }}">
    Данные продавца
</a>
<a href="{{ route('user.tasks.index') }}"
   class="{{ (request()->segment(3) == 'tasks') ? 'active' : '' }}">
    Помощь
</a>