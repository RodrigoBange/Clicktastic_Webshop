<?php
if (!isset($_SESSION['cart'])) {
    // Create cart
    $_SESSION['cart'] = array();
}

if (isset($_GET['product_id']) && isset($_GET['product_quantity'])) {
    // Get values
    $product_id = (int)$_GET['product_id'];
    $product_quantity = (int)$_GET['product_quantity'];

    // Default values;
    $deleteProduct = false;

    // If product exists
    if (isset($_SESSION['cart'][$product_id]) == $product_id) {
        // Update values
        if ($product_quantity > 0) { // If value is greater than 0, update
            // In case of user attempting to enter higher number
            if ($product_quantity > 10) {
                $product_quantity = 10;
            }

            $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
        } else { // If value is 0, delete product from cart
            unset($_SESSION['cart'][$product_id]);
            $deleteProduct = true;
        }
    }

    $totalQuantity = $navFunc->getCount();
    $subTotal = $productService->getSubtotalPrice();
    $cartEmpty = empty($_SESSION['cart']);

    // Return new values
    $replies = array(
        'deleteProduct' => $deleteProduct,
        'totalQuantity' => $totalQuantity,
        'subTotal' => $subTotal,
        'cartEmpty' => $cartEmpty
    );
    echo json_encode($replies);
}
