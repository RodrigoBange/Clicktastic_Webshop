<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Confirm Purchase</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script type="text/javascript" src="../../js/confirm_purchase.js"></script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="page pt-5 pb-5 bg-light">
    <div class="container">
        <div class="pt-5">
            <h2>Confirm your information</h2>
        </div>
        <div class="row">
            <div class="col-md-5 order-md-3 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3 sticky-xl-top sticky-lg-top sticky-md-top"
                    style="top: 70px;">
                    <span class="text-muted">Your items</span>
                </h4>
                <?php
                if (!empty($cartProducts)) {
                ?>
                <ul class="list-group mb-3 sticky-xl-top sticky-lg-top sticky-md-top" style="top: 115px;">
                <?php
                    foreach ($cartProducts as $cartProduct) {
                    ?>
                        <li class="list-group-item d-flex lh-condensed">
                            <img class="w-25"
                                 src="../../images/<?= htmlspecialchars($cartProduct->image); ?>" alt="keyboard">
                            <div class="flex-grow-1">
                                <h6 class="my-0"><?= htmlspecialchars($cartProduct->name); ?></h6>
                                <small class="text-muted">Quantity:
                                    <?= $_SESSION['cart'][$cartProduct->id]['product_quantity'] ?>x
                                </small>
                                <small class="text-muted">&euro; <?= $cartProduct->price ?></small>
                            </div>
                            <span class="text-muted text-nowrap">&euro;
                                <?= number_format($cartProduct->price * $_SESSION['cart'][$cartProduct->id]['product_quantity'], 2);
                                ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span class="text-muted">&euro; <?= $subtotal ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Shipping</span>
                        <span class="text-muted">&euro; <?= $shipping ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Euro)</span>
                        <strong>&euro; <?= $total ?> </strong>
                    </li>
                    <?php
                }
                ?>
                </ul>
                <button class="btn btn-theme btn-lg btn-block text-white sticky-xl-top sticky-lg-top sticky-md-top"
                        type="submit" onclick="confirmPurchase(<?= json_encode($_POST)?>)" style="top: 320px;">Confirm Purchase</button>
            </div>
            <div class="col-md-7 order-md-1">
                <h4 class="mb-3">Shipping address</h4>
                <div id="confirm-view">
                    <div class="mb-3 d-flex flex-column">
                        <?php
                        if (isset($_POST['shippingFirstName'])) { // Display shipping information, else billing info
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_POST['shippingFirstName']) . " " .
                                htmlspecialchars($_POST['shippingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['shippingAddress']) . " " .
                                htmlspecialchars($_POST['shippingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['shippingCity']) . ", " .
                                htmlspecialchars($_POST['shippingState']) . " " .
                                htmlspecialchars($_POST['shippingZip'])?> </span>
                        </row>
                        <?php
                        } else { // Display billing
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingFirstName']) . " " .
                                htmlspecialchars($_POST['billingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingAddress']) . " " .
                                htmlspecialchars($_POST['billingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingCity']) . ", " .
                                htmlspecialchars($_POST['billingState']) . " " .
                                htmlspecialchars($_POST['billingZip'])?> </span>
                        </row>
                        <?php
                        }
                        ?>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment method</h4>
                    <div class="mb-3 d-flex flex-column">
                        <?php
                        if (isset($_POST['paymentMethod'])) { // If paid by debit/credit
                            if ($_POST['paymentMethod'] == "creditCard" || $_POST['paymentMethod'] == "debitCard") {
                            ?>
                            <row>
                                <span><strong>Card ending in:
                                    </strong><?= substr(htmlspecialchars($_POST['cardNumber']), -4) ?></span>
                            </row>
                            <?php
                            } else { // Paypal
                                ?>
                                <row>
                                    <span>Paypal: <?= htmlspecialchars($_POST['paypalEmail']) ?></span>
                                </row>
                                <?php
                            }
                        }
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingFirstName']) . " " .
                                htmlspecialchars($_POST['billingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingAddress']) . " " .
                                htmlspecialchars($_POST['billingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingCity']) . ", " .
                                htmlspecialchars($_POST['billingState']) . " " .
                                htmlspecialchars($_POST['billingZip'])?> </span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_POST['billingPhoneNumber']) ?></span>
                        </row>
                    </div>
                    <hr class="mb-4">
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
