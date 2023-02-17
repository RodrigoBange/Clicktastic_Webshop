<?php
// Service
require_once(__DIR__ . "/../services/ProductService.php");
require_once(__DIR__ . "/../services/UserService.php");
require_once(__DIR__ . "/../services/OrderService.php");

// Model
require_once(__DIR__ . "/../models/NavbarFunctions.php");

class CartController
{
    private ProductService $productService;
    private UserService $userService;
    private OrderService $orderService;
    private NavbarFunctions $navFunc;

    public function __construct()
    {
        // Initialize
        $this->productService = new ProductService();
        $this->userService = new UserService();
        $this->orderService = new OrderService();
        $this->navFunc = new NavbarFunctions();
    }

    public function shoppingcart() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $productService->getCartProducts();

        // Load the view
        require_once(__DIR__ . "/../views/cart/shoppingcart.php");
    }

    public function checkout() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $productService->getCartProducts();

        $user = $this->userService->getUser($_SESSION['email']);

        // Load the  view
        require_once(__DIR__ . "/../views/cart/checkout.php");
    }

    public function confirmation() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get datta of products in shopping cart to load into view
        $cartProducts = $productService->getCartProducts();

        // Load the view
        require_once(__DIR__ . "/../views/cart/confirmation.php");
    }

    public function addtocart() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/cart/addtocart.php");
    }

    public function editcart() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/cart/editcart.php");
    }

    public function processpurchase() : void
    {
        // Service
        $productService = $this->productService;
        $userService = $this->userService;
        $orderService = $this->orderService;

        // Load the view
        require_once(__DIR__ . "/../views/cart/processpurchase.php");
    }
}
