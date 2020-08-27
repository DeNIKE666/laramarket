<?php


namespace App\Services\Order;


use App\Models\Order;
use App\Models\OrderHistoryStatuses;

class OrderHistoryStatusService
{
    /**
     * Добавить статус в историю
     *
     * @param Order       $order
     * @param int         $status
     * @param string|null $notes
     *
     * @return OrderHistoryStatuses
     * @author Anton Reviakin
     *
     */
    public function storeOrderHistoryStatus(Order $order, int $status, string $notes = null): OrderHistoryStatuses
    {
        return OrderHistoryStatuses::create([
            'order_id' => $order->id,
            'status'   => $status,
            'notes'    => $notes,
        ]);
    }
}