<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function find($id)
    {
        return $this->orderRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->orderRepository->createOrder($data);
    }

    public function update($id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->orderRepository->delete($id);
    }

    public function getUserOrders($userId)
    {
        return $this->orderRepository->getUserOrders($userId);
    }

    public function getOrdersByStatus($status)
    {
        return $this->orderRepository->getOrdersByStatus($status);
    }

    public function searchOrders($query)
    {
        return $this->orderRepository->searchOrders($query);
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->orderRepository->updateOrderStatus($orderId, $status);
    }
}
