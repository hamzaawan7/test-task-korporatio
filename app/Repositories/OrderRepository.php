<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository extends EloquentRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getUserOrders($userId)
    {
        return $this->model->where('user_id', $userId)
            ->with('product')
            ->latest()
            ->paginate(10);
    }

    public function getOrdersByStatus($status)
    {
        return $this->model->where('status', $status)
            ->with(['user', 'product'])
            ->latest()
            ->paginate(10);
    }

    public function searchOrders($query)
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('customer_name', 'like', "%{$query}%")
                ->orWhere('customer_email', 'like', "%{$query}%")
                ->orWhere('id', 'like', "%{$query}%");
        })
            ->with('product')
            ->paginate(10);
    }

    public function createOrder(array $data)
    {
        return $this->model->create($data);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = $this->find($orderId);
        $order->update(['status' => $status]);
        return $order;
    }
}
