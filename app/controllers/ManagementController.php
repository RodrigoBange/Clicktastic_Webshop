<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/ProductService.php');
require_once(__DIR__ . '/../services/OrderService.php');

// Models
require_once(__DIR__ . "/../models/NavbarFunctions.php");

class ManagementController
{
    private UserService $userService;
    private ProductService $productService;
    private OrderService $orderService;
    private NavbarFunctions $navFunc;

    public function __construct()
    {
        // Initialize
        $this->userService = new UserService();
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
        $this->navFunc = new NavbarFunctions();
    }

    public function overview() : void
    {
        // Service
        $productService = $this->productService;

        // Get user information
        $user = $this->userService->getUser($_SESSION['email']);

        // Get all orders of user
        $orders = $this->orderService->getAllOrders();

        // Get order items
        foreach ($orders as $order) {
            $products = $this->productService->getProductsOfOrder($order->id);
            $order->products[] = $products;
        }

        // Navigation Functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/account/orders.php");
    }
}
