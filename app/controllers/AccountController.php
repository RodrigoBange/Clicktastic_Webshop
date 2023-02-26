<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/ProductService.php');
require_once(__DIR__ . '/../services/OrderService.php');

// Models
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class AccountController
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

    public function account() : void
    {
        // If user is not logged in, direct to login page
        if (!isset($_SESSION['user'])) {
            header('location: /login/login');
            return;
        }

        // Get user object
        $user = $this->userService->unserializeUser();

        // Navigation Functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/account/account.php');
    }

    public function editaccount() : void
    {
        // If user is not logged in, direct to login page
        if (!isset($_SESSION['user'])) {
            header('location: /login/login');
            return;
        }

        // Get user object
        $user = $this->userService->unserializeUser();

        // Navigation Functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/account/editaccount.php');
    }

    public function updateaccount() : void
    {
        // Get user object
        $user = $this->userService->unserializeUser();

        echo json_encode($this->userService->updateUser($user));
    }

    public function orders() : void
    {
        // Service
        $productService = $this->productService;

        // Get user object
        $user = $this->userService->unserializeUser();

        // Get all orders of user
        $orders = $this->orderService->getOrdersByCustomerId($user->id);

        // Get order items
        foreach ($orders as $order) {
            $products = $this->productService->getProductsOfOrder($order->id);
            $order->products[] = $products;
        }

        // Navigation Functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/account/orders.php');
    }

    public function getcountry(): void {
        // Get user object
        $user = $this->userService->unserializeUser();

        if (isset($user->country)) {
            echo json_encode(htmlspecialchars($user->country));
        } else {
            echo json_encode(null);
        }
    }
}
