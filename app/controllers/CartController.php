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

    /**
     * Opens the shopping cart overview
     */
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

    /**
     * Opens the checkout page
     */
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

    /**
     * Opens the confirmation page
     */
    public function confirmation(): void
    {
        if (isset($_POST['submit'])) { // Save POST for processing
                $_SESSION['confirmationData'] = $_POST;
        }

        // If cart is empty or post is incomplete, return to shopping cart instead
        if (empty($_SESSION['cart']) || empty($_SESSION['confirmationData'])) {
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

    /**
     * AJAX, adds an item to the cart and returns the new count
     */
    public function addtocart(): void
    {
        // Add product to cart
        $this->cartService->addToCart();

        // Echo new count
        echo $this->navFunc->getCount();
    }

    /**
     * AJAX, updates the cart
     */
    public function editcart(): void
    {
        // Update cart
        echo json_encode($this->cartService->editCart($this->navFunc, $this->productService));
    }

    /**
     * Opens the purchase processing page
     */
    public function processpurchase(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/cart/processpurchase.php');
    }

    /**
     * AJAX, processes the payment
     */
    public function processment(): void
    {
        // Process purchase
        echo json_encode($this->orderService->processPurchase($this->userService, $this->productService));
    }

    /**
     * Opens the successful payment page
     */
    public function paymentsuccess(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Empties information
        $this->cartService->emptyCart();

        // Load the view
        require_once(__DIR__ . '/../views/cart/paymentsuccess.php');
    }

    /**
     * Opens the failure payment page
     */
    public function paymentfailure(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/cart/paymentfailure.php');
    }
}
