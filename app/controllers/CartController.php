<?php
// Service
require_once(__DIR__ . '/../services/CartService.php');
require_once(__DIR__ . '/../services/ProductService.php');
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/OrderService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class CartController
{
    private CartService $cartService;
    private ProductService $productService;
    private UserService $userService;
    private OrderService $orderService;
    private NavbarFunctions $navFunc;

    public function __construct()
    {
        // Initialize
        $this->cartService = new CartService();
        $this->productService = new ProductService();
        $this->userService = new UserService();
        $this->orderService = new OrderService();
        $this->navFunc = new NavbarFunctions();
    }

    public function shoppingcart(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $this->productService->getCartProducts();

        // Get the subtotal, shipping cost and total to display
        $subtotal = $this->productService->getSubtotalPrice();
        $shipping = $this->productService->getShippingCost();
        $total = $this->productService->getTotalPrice();

        // Load the view
        require_once(__DIR__ . '/../views/cart/shoppingcart.php');
    }

    public function checkout(): void
    {
        // If cart is empty, return to shoppingcart instead
        if (empty($_SESSION['cart'])) {
            header('location: /cart/shoppingcart');
            return;
        }

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $this->productService->getCartProducts();

        // Get user object
        $user = $this->userService->unserializeUser();

        // Get the subtotal, shipping cost and total to display
        $subtotal = $this->productService->getSubtotalPrice();
        $shipping = $this->productService->getShippingCost();
        $total = $this->productService->getTotalPrice();

        // Load the  view
        require_once(__DIR__ . '/../views/cart/checkout.php');
    }

    public function confirmation(): void
    {
        // If cart is empty or post is incomplete, return to shopping cart instead
        if (empty($_SESSION['cart']) || !isset($_POST['billingFirstName'])) {
            header('location: /cart/shoppingcart');
            return;
        }

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get datta of products in shopping cart to load into view
        $cartProducts = $this->productService->getCartProducts();

        // Get the subtotal, shipping cost and total to display
        $subtotal = $this->productService->getSubtotalPrice();
        $shipping = $this->productService->getShippingCost();
        $total = $this->productService->getTotalPrice();

        // Load the view
        require_once(__DIR__ . '/../views/cart/confirmation.php');
    }

    public function addtocart(): void
    {
        // Add product to cart
        $this->cartService->addToCart();

        // Echo new count
        echo $this->navFunc->getCount();
    }

    public function editcart(): void
    {
        // Update cart
        $this->cartService->editCart($this->navFunc, $this->productService);
    }

    public function processpurchase(): void
    {
        // Process purchase
        $this->orderService->processPurchase();
    }
}
