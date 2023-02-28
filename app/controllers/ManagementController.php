<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/ProductService.php');
require_once(__DIR__ . '/../services/OrderService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class ManagementController
{
    private UserService $userService;
    private ProductService $productService;
    private OrderService $orderService;
    private NavbarFunctions $navFunc;
    private string $page;

    public function __construct()
    {
        // Initialize
        $this->userService = new UserService();
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
        $this->navFunc = new NavbarFunctions();
        $this->page = 'management';
    }

    /**
     * Opens the management overview page
     */
    public function overview() : void
    {
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header("location: /login/login");
            return;
        }

        // Get user information TODO: remove...
        $user = $this->userService->unserializeUser();

        // Get all orders
        $orders = $this->orderService->getAllOrders();

        // Navigation Functions
        $navFunc = $this->navFunc;
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . "/../views/management/overview.php");
    }
}
