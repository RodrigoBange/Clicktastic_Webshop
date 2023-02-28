<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Your item overview</title>
    <script type="text/javascript" src="../../js/edit_cart.js"></script>
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
                                <div class="product pt-4 pb-4" id="product-<?= $cartProduct->getId() ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="/shop/product?id=<?= $cartProduct->getId() ?>"
                                               class="img-fluid mx-auto d-block border">
                                                <img class="img-fluid mx-auto d-block"
                                                     src="../../images/<?= htmlspecialchars($cartProduct->getImage()) ?>">
                                            </a>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="product-name">
                                                            <a href="/shop/product?id=<?= $cartProduct->getId() ?>"
                                                               class="text-decoration-none text-black">
                                                                <h5 class="mb-1"><?= $cartProduct->getName() ?></h5></a>
                                                            <div class="product-info">
                                                                <div class="badge bg-theme mb-1"><span class="value">
                                                                    <?= $cartProduct->getCompany() ?></span></div>
                                                                <div>Size: <span class="value">
                                                                        <?= $cartProduct->getSize() ?></span></div>
                                                                <div>Color: <span class="text-bg-light">
                                                                        <?= $cartProduct->getColor() ?></span></div>
                                                                <div>Switches: <span class="value">
                                                                        <?= $cartProduct->getSwitches() ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="quantity"><span>Quantity</span></label>
                                                        <input id="quantity-<?= $cartProduct->getId() ?>" type="number"
                                                           value ="<?php
                                                           // Get quantity
                                                           echo $_SESSION['cart'][$cartProduct->getId()]['product_quantity'];
                                                           ?>" min="0" max="10" onchange="editQuantity(this)"
                                                               class="form-control quantity-input">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5 class="fw-semibold pt-4 mt-1">&euro;
                                                            <?php
                                                            // Get price * quantity
                                                            echo number_format($cartProduct->getPrice(), 2);
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
                                    &euro; <?= $subtotal ?></span></div>
                                <div class="summary-item row pt-2 pb-2"><span class="text col-md-4 col-sm-2">Shipping
                                </span><span class="fw-semibold col-md-4 col-sm-4" id="shipping">&euro;
                                    <?= $shipping ?></span></div>
                                <div class="summary-item row"><span class="text col-md-4 col-sm-2"><b>Total</b>
                                </span><span class="fw-semibold col-md-5 col-sm-4" id="total">
                                &euro; <?= $total ?></span></div>
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
