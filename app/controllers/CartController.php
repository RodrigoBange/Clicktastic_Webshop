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

    public function shoppingcart() : void
    {
        // Service
        $productService = $this->productService;

        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $productService->getCartProducts();

        // Load the view
        require_once(__DIR__ . '/../views/cart/shoppingcart.php');
    }

    public function checkout() : void
    {
        if (empty($_SESSION['cart'])) {
            header("location: /cart/shoppingcart");
            return;
        }
        // Navigation functions
        $navFunc = $this->navFunc;

        // Get data of products in shopping cart to load into view
        $cartProducts = $this->productService->getCartProducts();

        // Get user object
        $user = $this->userService->unserializeUser();

        // Format subtotal for display
        $subtotal = number_format($this->productService->getSubtotalPrice() + 5.99, 2);

        // Load the  view
        require_once(__DIR__ . '/../views/cart/checkout.php');
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
        require_once(__DIR__ . '/../views/cart/confirmation.php');
    }

    public function addtocart() : void
    {
        // Add product to cart
        $this->cartService->addToCart();

        // Echo new count
        echo $this->navFunc->getCount();
    }

    public function editcart() : void
    {
        // Update cart
        $this->cartService->editCart($this->navFunc, $this->productService);
    }

    public function processpurchase() : void
    {
        // Service
        $productService = $this->productService;
        $userService = $this->userService;
        $orderService = $this->orderService;

        // Load the view
        require_once(__DIR__ . '/../views/cart/processpurchase.php');
    }
}
