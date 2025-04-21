<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserOrders($userId);
    public function getOrdersByStatus($status);
    public function searchOrders($query);
    public function createOrder(array $data);
    public function updateOrderStatus($orderId, $status);
}
