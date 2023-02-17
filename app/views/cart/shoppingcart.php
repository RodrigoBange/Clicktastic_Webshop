<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Your item overview</title>
    <script>
        function editQuantity($button) {
            // Get number of ID and new quantity
            const $id = $button.id.match(/\d/g).join("");
            const $quantity = $button.value;

            const $cartcount = document.getElementById("cartcount");
            const $items = document.getElementById("items");
            const $summary = document.getElementById("summary");
            const $subtotal = document.getElementById("subtotal");
            const $total = document.getElementById("total");
            const $shipping = document.getElementById("shipping");
            let $shippingcost = 5.99;

            $.ajax({
                url: '/cart/editcart',
                data: {product_id : $id, product_quantity : $quantity},
                success: function(reply) {
                    $reply = JSON.parse(reply);

                    // Check if product quantity reached 0
                    if ($reply.deleteProduct) {
                        var $product = document.getElementById("product-" + $id);
                        $product.remove();

                        // Check if there are no items left
                        if ($reply.cartEmpty === true) {
                            $shippingcost = 0.00;
                            $shipping.textContent = "\u20ac " + $shippingcost.toFixed(2);

                            // Disable checkout
                            if (!$summary.classList.contains("collapse")) {
                                $summary.classList.add("collapse");
                            }

                            // Display message
                            $items.insertAdjacentHTML('afterbegin',
                                '<h5>Your cart is currently empty.</h5>' +
                                '<a href="/shop/products" class="btn btn-theme text-white btn-lg btn-block">' +
                                'Browse products</a>');
                        }
                    }
                    // Set pricing
                    $cartcount.textContent = $reply.totalQuantity;
                    $subtotal.textContent = "\u20ac " + $reply.subTotal.toFixed(2);
                    $total.textContent = "\u20ac " + ($reply.subTotal + $shippingcost).toFixed(2);

                    // In case of input abuse
                    if ($quantity > 10) {
                        $button.value = 10;
                    }
                },
                error: function(req, status, error) {
                    console.log( 'Something went wrong: ', status, error, req );
                }
            });
        }
    </script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="page pt-5 pb-5 bg-light">
    <section class="pt-5">
        <div class="container">
            <div>
                <h2>Your items</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <div class="items" id="items">
                            <?php
                            if (!empty($cartProducts)) {
                            foreach ($cartProducts as $cartProduct) {
                            ?>
                                <div class="product pt-4 pb-4" id="product-<?= $cartProduct->id ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="/shop/product?id=<?= $cartProduct->id ?>"
                                               class="img-fluid mx-auto d-block border">
                                                <img class="img-fluid mx-auto d-block"
                                                     src="../../images/<?= htmlspecialchars($cartProduct->image) ?>">
                                            </a>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="product-name">
                                                            <a href="/shop/product?id=<?= $cartProduct->id ?>"
                                                               class="text-decoration-none text-black">
                                                                <h5 class="mb-1"><?= $cartProduct->name ?></h5></a>
                                                            <div class="product-info">
                                                                <div class="badge bg-theme mb-1"><span class="value">
                                                                    <?= $cartProduct->company ?></span></div>
                                                                <div>Size: <span class="value">
                                                                        <?= $cartProduct->size ?></span></div>
                                                                <div>Color: <span class="text-bg-light">
                                                                        <?= $cartProduct->color ?></span></div>
                                                                <div>Switches: <span class="value">
                                                                        <?= $cartProduct->switches ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="quantity"><span>Quantity</span></label>
                                                        <input id="quantity-<?= $cartProduct->id ?>" type="number"
                                                           value ="<?php
                                                           // Get quantity
                                                           echo $_SESSION['cart'][$cartProduct->id]['product_quantity'];
                                                           ?>" min="0" max="10" onchange="editQuantity(this)"
                                                               class="form-control quantity-input">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5 class="fw-semibold pt-4 mt-1">&euro;
                                                            <?php
                                                            // Get price * quantity
                                                            echo number_format($cartProduct->price, 2);
                                                            ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            } else {
                                ?>
                                <h5>Your cart is currently empty.</h5>
                                <a href="/shop/products" class="btn btn-theme text-white btn-lg btn-block">
                                    Browse products</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if (!empty($cartProducts)) {
                        ?>
                        <div class="col-md-12 col-lg-3 border-start" id="summary">
                            <div class="summary sticky-xl-top sticky-lg-top sticky-md-top" style="top: 70px;">
                                <h4 class="text-muted">Summary</h4>
                                <div class="summary-item row"><span class="text col-md-4 col-sm-2">Subtotal
                                </span><span class="fw-semibold col-md-5 col-sm-4" id="subtotal">
                                    &euro;
                                    <?php
                                    echo number_format($productService->getSubtotalPrice(), 2);
                                    ?></span></div>
                                <div class="summary-item row pt-2 pb-2"><span class="text col-md-4 col-sm-2">Shipping
                                </span><span class="fw-semibold col-md-4 col-sm-4" id="shipping">&euro;
                                    <?php
                                        echo number_format(5.99, 2);
                                    ?></span></div>
                                <div class="summary-item row"><span class="text col-md-4 col-sm-2"><b>Total</b>
                                </span><span class="fw-semibold col-md-5 col-sm-4" id="total">
                                &euro; <?php
                                    echo number_format($productService->getSubtotalPrice() + 5.99, 2);
                                ?></span></div>
                                <a href="/cart/checkout" class="btn btn-theme text-white btn-lg btn-block mt-3">
                                    Checkout</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
