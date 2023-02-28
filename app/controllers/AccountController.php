<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/ProductService.php');
require_once(__DIR__ . '/../services/OrderService.php');

// Model
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

    /**
     * Opens the account overview page
     */
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

    /**
     * Opens the account edit page
     */
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

    /**
     * AJAX, updates account and echo's the result
     */
    public function updateaccount() : void
    {
        // Get user object
        $user = $this->userService->unserializeUser();

        echo json_encode($this->userService->updateUser($user));
    }

    /**
     * Opens the order overview page
     */
    public function orders() : void
    {
        // If user is not logged in, direct to login page
        if (!isset($_SESSION['user'])) {
            header('location: /login/login');
            return;
        }

        // Get user object
        $user = $this->userService->unserializeUser();

        // Get all orders of user
        $orders = $this->orderService->getOrdersByCustomerId($user->getId());

        // Navigation Functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/account/orders.php');
    }

    /**
     * AJAX, gets the user's country
     */
    public function getcountry(): void {
        // Get user object
        $user = $this->userService->unserializeUser();

        if ($user->getCountry() !== null) {
            echo json_encode(htmlspecialchars($user->getCountry()));
        } else {
            echo json_encode(null);
        }
    }
}
