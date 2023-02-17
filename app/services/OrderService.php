<?php
// Repository
require(__DIR__. ' /../repositories/OrderRepository.php');

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function createOrder($customerId, $orderInfo, $items) : bool
    {
        try {
            // Create order
            $lastId = $this->orderRepository->createOrder($customerId, $orderInfo);

            // Add order information
            $this->orderRepository->addOrderItems($lastId, $items);
        } catch (Exception $e) {
            error_log($e);
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function getOrdersByCustomerId($id): array|null
    {
        return $this->orderRepository->getOrdersById($id);
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }
}
