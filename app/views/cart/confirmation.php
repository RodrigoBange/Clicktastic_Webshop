<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Confirm Purchase!</title>
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
                <a class="btn btn-theme btn-lg btn-block text-white sticky-xl-top sticky-lg-top sticky-md-top"
                        href="/cart/processpurchase" style="top: 320px;">Confirm Purchase</a>
            </div>
            <div class="col-md-7 order-md-1">
                <h4 class="mb-3">Shipping address</h4>
                <div id="confirm-view">
                    <div class="mb-3 d-flex flex-column">
                        <?php
                        if (isset($_SESSION['confirmationData']['shippingFirstName'])) { // Display shipping information, else billing info
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['shippingFirstName']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['shippingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['shippingAddress']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['shippingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['shippingCity']) . ", " .
                                htmlspecialchars($_SESSION['confirmationData']['shippingState']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['shippingZip'])?> </span>
                        </row>
                        <?php
                        } else { // Display billing
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingFirstName']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingAddress']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingCity']) . ", " .
                                htmlspecialchars($_SESSION['confirmationData']['billingState']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingZip'])?> </span>
                        </row>
                        <?php
                        }
                        ?>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment method</h4>
                    <div class="mb-3 d-flex flex-column">
                        <?php
                        if (isset($_SESSION['confirmationData']['paymentMethod'])) { // If paid by debit/credit
                            if ($_SESSION['confirmationData']['paymentMethod'] == "creditCard" ||
                                $_SESSION['confirmationData']['paymentMethod'] == "debitCard") {
                            ?>
                            <row>
                                <span><strong>Card ending in:
                                    </strong><?= substr(htmlspecialchars($_SESSION['confirmationData']['cardNumber']), -4) ?></span>
                            </row>
                            <?php
                            } else { // Paypal
                                ?>
                                <row>
                                    <span>Paypal: <?= htmlspecialchars($_SESSION['confirmationData']['paypalEmail']) ?></span>
                                </row>
                                <?php
                            }
                        }
                        ?>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingFirstName']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingLastName']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingAddress']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingAddress2']) ?></span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingCity']) . ", " .
                                htmlspecialchars($_SESSION['confirmationData']['billingState']) . " " .
                                htmlspecialchars($_SESSION['confirmationData']['billingZip'])?> </span>
                        </row>
                        <row>
                            <span><?= htmlspecialchars($_SESSION['confirmationData']['billingPhoneNumber']) ?></span>
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
