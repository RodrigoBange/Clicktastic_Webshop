<?php

class CartService
{
    /**
     * Checks if a cart exists, or creates a session value for it
     */
    public function cartExists(): void
    {
        if (!isset($_SESSION['cart'])) {
            // Create cart
            $_SESSION['cart'] = array();
        }
    }

    /**
     * Adds a product to the cart
     */
    public function addToCart(): void
    {
        // Create cart if it doesn't exist yet
        $this->cartExists();

        if (isset($_GET['product_id']) && isset($_GET['product_price']) && isset($_GET['product_quantity'])) {
            // Get values
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
        }
    }

    /**
     * Edits the cart with products or removes products.
     */
    public function editCart(NavbarFunctions $navFunc, ProductService $productService)
    {
        // Create cart if it doesn't exist yet
        $this->cartExists();

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

            // Get new values
            $totalQuantity = $navFunc->getCount();
            $subTotal = $productService->getSubtotalPrice();
            $cartEmpty = empty($_SESSION['cart']);

            // Return new values
            return array(
                'deleteProduct' => $deleteProduct,
                'totalQuantity' => $totalQuantity,
                'subTotal' => $subTotal,
                'cartEmpty' => $cartEmpty
            );
        }
    }

    /**
     * Empties the cart and overview data
     * Called after a successful payment
     */
    public function emptyCart(): void
    {
        // Empties cart & overview data
        unset($_SESSION['cart']);
        unset($_SESSION['confirmationData']);
    }
}