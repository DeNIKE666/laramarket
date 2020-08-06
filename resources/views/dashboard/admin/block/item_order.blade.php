<tr>
    <td>{{ $order->id }}</td>
    <td>{{ $order->cost }}</td>
    <td>{{ $order->status }}</td>
    <td>{{ $order->created_at }}</td>
    <td>
        @can('role-user')
        <a href="">
            Подробнее
        </a>
        @endcan
        @can('role-shop')
            <a href="{{ route('order.detail', [$order]) }}">
                Подробнее
            </a>
        @endcan
        @can('role-admin')
        <a href="">
            Подробнее
        </a>
        @endcan
    </td>
</tr>

