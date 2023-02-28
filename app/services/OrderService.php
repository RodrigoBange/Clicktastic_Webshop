<?php
// Repository
require_once(__DIR__ . '/../repositories/OrderRepository.php');

class OrderService
{
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    /**
     * Processes the purchase info before creating the order
     */
    public function processPurchase(UserService $userService, ProductService $productService): bool
    {
        $result = false;

        if (isset($_SESSION['confirmationData']['billingEmail'])) {
            // Get user info in array
            $userInfo = $this->convertUserInfo();

            // Check if customer exists & get the customer id
            if (!$userService->isPrevCustomer($_SESSION['confirmationData']['billingEmail'])) {
                // If customer hasn't purchased something before, register customer info
                $userService->registerCustomer($userInfo);
            }
            $customerId = $userService->getUserId($_SESSION['confirmationData']['billingEmail']);

            if ($customerId != 0) { // If customer exists, create order
                $items = $_SESSION['cart'];

                // Get the order info required
                $orderInfo = $this->getOrderInfo($productService);

                // Create order
                $result = $this->createOrder($customerId, $orderInfo, $items);
            }
        }
        return $result;
    }

    /**
     * Converts the POST info to an array for processing
     */
    private function convertUserInfo(): array
    {
        return array(
            'email' => $_SESSION['confirmationData']['billingEmail'],
            'phone_number' => $_SESSION['confirmationData']['billingPhoneNumber'],
            'first_name' => $_SESSION['confirmationData']['billingFirstName'],
            'last_name' => $_SESSION['confirmationData']['billingLastName'],
            'address' => $_SESSION['confirmationData']['billingAddress'],
            'address_optional' => $_SESSION['confirmationData']['billingAddress2'],
            'city' => $_SESSION['confirmationData']['billingCity'],
            'state' => $_SESSION['confirmationData']['billingState'],
            'postal_code' => $_SESSION['confirmationData']['billingZip'],
            'country' => $_SESSION['confirmationData']['billingCountry'],
        );
    }

    /**
     * Creates the order info required for the database
     */
    public function getOrderInfo(ProductService $productService): array
    {
        if (isset($_SESSION['confirmationData']['shippingAddress'])) {
            return array(
                'address' => $_SESSION['confirmationData']['shippingAddress'],
                'address_optional' => $_SESSION['confirmationData']['shippingAddress2'],
                'city' => $_SESSION['confirmationData']['shippingCity'],
                'state' => $_SESSION['confirmationData']['shippingState'],
                'postal_code' => $_SESSION['confirmationData']['shippingZip'],
                'country' => $_SESSION['confirmationData']['shippingCountry'],
                'phone_number' => $_SESSION['confirmationData']['billingPhoneNumber'],
                'total' => $productService->getTotalPrice()
            );
        } else {
            return array(
                'address' => $_SESSION['confirmationData']['billingAddress'],
                'address_optional' => $_SESSION['confirmationData']['billingAddress2'],
                'city' => $_SESSION['confirmationData']['billingCity'],
                'state' => $_SESSION['confirmationData']['billingState'],
                'postal_code' => $_SESSION['confirmationData']['billingZip'],
                'country' => $_SESSION['confirmationData']['billingCountry'],
                'phone_number' => $_SESSION['confirmationData']['billingPhoneNumber'],
                'total' => $productService->getTotalPrice()
            );
        }
    }

    /**
     * Creates a new order
     */
    public function createOrder(int $customerId, $orderInfo, $items) : bool
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

    /**
     * Gets orders from a specific customer
     */
    public function getOrdersByCustomerId(int $id): array|null
    {
        return $this->orderRepository->getOrdersById($id);
    }

    /**
     * Gets all orders from all customers
     */
    public function getAllOrders(): bool|array|null
    {
        return $this->orderRepository->getAllOrders();
    }
}
