<?php

class NavbarFunctions
{
    /**
     * Gets the total count of products in the cart including quantity.
     */
    public function getCount() : int
    {
        $products = 0;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $products += $value['product_quantity'];
            }
        }
        // Return count
        return $products;
    }

    /**
     * Sets up the username and its href
     */
    public function displayUser($page) : void
    {
        if (isset($_SESSION['user'])) {
            ?>
            <a href="/account/orders" class="nav-item nav-link <?= $page == 'orders' ? 'active' : ''?>">Orders</a>
            <a href="/account/account" class="nav-item nav-link <?= $page == 'account' ? 'active' : ''?>">
                <?php
                echo "Hello, " . htmlspecialchars($_SESSION['display_name']);
                ?>
            </a>
            <a href="/login/logout" class="nav-item nav-link">Logout</a>
            <?php
        } else {
            ?>
            <a href="/login/login" class="nav-item nav-link <?= $page == 'login' ? 'active' : ''?>">Login</a>
            <?php
        }
    }

    /**
     * Creates the links for management functionality
     */
    public function management($page) : void
    {
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
            ?>
            <a href="/management/overview" class="nav-item nav-link <?= $page == 'management' ? 'active' : ''?>">Management</a>
            <?php
        }
    }
}
