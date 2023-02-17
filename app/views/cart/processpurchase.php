<?php
if (isset($_POST['data']['billingEmail'])) {
    $userInfo = array(
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

    // Save the customer's info
    if (!$userService->isPrevCustomer($_POST['data']['billingEmail'])) {
        echo "result: " . $userService->isPrevCustomer($_POST['data']['billingEmail']);
        // If customer hasn't purchased something before...
        // Register customer info
        $userService->registerCustomer($userInfo);
    }

    // Get customer id
    $customerId = $userService->getUserId($_POST['data']['billingEmail']);

    if ($customerId != 0) { // Create order
        $items = $_SESSION['cart'];

        if (isset($_POST['data']['shippingAddress'])) {
            $orderInfo = array(
                'address' => $_POST['data']['shippingAddress'],
                'address_optional' => $_POST['data']['shippingAddress2'],
                'city' => $_POST['data']['shippingCity'],
                'state' => $_POST['data']['shippingState'],
                'postal_code' => $_POST['data']['shippingZip'],
                'country' => $_POST['data']['shippingCountry'],
                'phone_number' => $_POST['data']['billingPhoneNumber'],
                'total' => $productService->getSubtotalPrice() + 5.99
            );
        } else {
            $orderInfo = array(
                'address' => $_POST['data']['billingAddress'],
                'address_optional' => $_POST['data']['billingAddress2'],
                'city' => $_POST['data']['billingCity'],
                'state' => $_POST['data']['billingState'],
                'postal_code' => $_POST['data']['billingZip'],
                'country' => $_POST['data']['billingCountry'],
                'phone_number' => $_POST['data']['billingPhoneNumber'],
                'total' => $productService->getSubtotalPrice() + 5.99
            );
        }
        if ($orderService->createOrder($customerId, $orderInfo, $items)) {
            echo "YAY";
        } else {
            echo "NAY";
        }
    }

    echo "Finished";
    echo true;
}
