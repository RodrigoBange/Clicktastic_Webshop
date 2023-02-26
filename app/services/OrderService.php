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
    public function processPurchase(UserService $userService, ProductService $productService): void
    {
        $result = false;

        if (isset($_POST['data']['billingEmail'])) {
            // Get user info in array
            $userInfo = $this->convertUserInfo();

            // Check if customer exists & get the customer id
            if (!$userService->isPrevCustomer($_POST['data']['billingEmail'])) {
                // If customer hasn't purchased something before, register customer info
                $userService->registerCustomer($userInfo);
            }
            $customerId = $userService->getUserId($_POST['data']['billingEmail']);

            if ($customerId != 0) { // If customer exists, create order
                $items = $_SESSION['cart'];

                // Get the order info required
                $orderInfo = $this->getOrderInfo($productService);

                // Create order
                $result = $this->createOrder($customerId, $orderInfo, $items);
            }
        }
        echo json_encode($result);
    }

    /**
     * Converts the POST info to an array for processing
     */
    private function convertUserInfo(): array
    {
        return array(
            'email' => $_POST['data']['billingEmail'],
            'phone_number' => $_POST['data']['billingPhoneNumber'],
            'first_name' => $_POST['data']['billingFirstName'],
            'last_name' => $_POST['data']['billingLastName'],
            'address' => $_POST['data']['billingAddress'],
            'address_optional' => $_POST['data']['billingAddress2'],
            'city' => $_POST['data']['billingCity'],
            'state' => $_POST['data']['billingState'],
            'postal_code' => $_POST['data']['billingZip'],
            'country' => $_POST['data']['billingCountry'],
        );
    }

    /**
     * Creates the order info required for the database
     */
    public function getOrderInfo(ProductService $productService): array
    {
        if (isset($_POST['data']['shippingAddress'])) {
            return array(
                'address' => $_POST['data']['shippingAddress'],
                'address_optional' => $_POST['data']['shippingAddress2'],
                'city' => $_POST['data']['shippingCity'],
                'state' => $_POST['data']['shippingState'],
                'postal_code' => $_POST['data']['shippingZip'],
                'country' => $_POST['data']['shippingCountry'],
                'phone_number' => $_POST['data']['billingPhoneNumber'],
                'total' => $productService->getTotalPrice()
            );
        } else {
            return array(
                'address' => $_POST['data']['billingAddress'],
                'address_optional' => $_POST['data']['billingAddress2'],
                'city' => $_POST['data']['billingCity'],
                'state' => $_POST['data']['billingState'],
                'postal_code' => $_POST['data']['billingZip'],
                'country' => $_POST['data']['billingCountry'],
                'phone_number' => $_POST['data']['billingPhoneNumber'],
                'total' => $productService->getTotalPrice()
            );
        }
    }

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

    public function getOrdersByCustomerId(int $id): array|null
    {
        return $this->orderRepository->getOrdersById($id);
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }
}
