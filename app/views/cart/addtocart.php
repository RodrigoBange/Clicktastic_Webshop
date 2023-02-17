<?php
if (!isset($_SESSION['cart'])) {
    // Create cart
    $_SESSION['cart'] = array();
}

if (isset($_GET['product_id']) && isset($_GET['product_price']) && isset($_GET['product_quantity'])) {

    $product_id = (int)$_GET['product_id'];
    $product_price = (double)$_GET['product_price'];
    $product_quantity = (int)$_GET['product_quantity'];

    // Check if item doesn't exist, add new product
    if (!isset($_SESSION['cart'][$product_id]) == $product_id) {
        $_SESSION['cart'][$product_id] =
            array(
                'product_id' => $product_id,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity
            );
    } else {
        // Add to quantity
        $_SESSION['cart'][$product_id]['product_quantity'] += $product_quantity;
        // If maximum is exceeded, put maximum
        if ($_SESSION['cart'][$product_id]['product_quantity'] > 10) {
            $_SESSION['cart'][$product_id]['product_quantity'] = 10;
        }
    }

    // Echo new count
    echo $navFunc->getCount();
}
