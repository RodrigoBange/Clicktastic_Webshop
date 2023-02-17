<?php
    if (empty($_SESSION['cart'])) {
        header("location: /cart/shoppingcart");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    <!--Delete the below line later. Only used for auto complete temporarily-->
    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Confirm Purchase</title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script>
        function confirmPurchase() {
            $.ajax({
                type: 'POST',
                url: '/cart/processpurchase',
                data: {
                    data: <?php echo json_encode($_POST); ?>
                },
                success: function(reply) {
                    // If all good, navigate to success screen
                    console.log("success" + reply)
                },
                error: function(req, status, error) {
                    // Display error
                    console.log( 'Something went wrong: ', status, error, req );
                }
            });
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom fixed-top">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img src="images/logo.svg" height="28" alt="Clicktastic">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="/shop/products" class="nav-item nav-link">Shop</a>
                <?php
                $navFunc->management();
                ?>
            </div>
            <div class="navbar-nav ms-auto">
                <a href="/cart/shoppingcart" class="nav-item nav-link">
                    <i class="fa fa-shopping-basket"></i>
                    <span id="cartcount">
                        <?php
                        echo $navFunc->getCount();
                        ?>
                    </span>
                </a>
                <?php
                $navFunc->displayUser();
                ?>
            </div>
        </div>
    </div>
</nav>
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
                                 src="../../images/<?= htmlspecialchars($cartProduct->image) ?>" alt="keyboard">
                            <div class="flex-grow-1">
                                <h6 class="my-0"><?= $cartProduct->name ?></h6>
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
                        <span>Shipping</span>
                        <span class="text-muted">&euro; 5.99</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Euro)</span>
                        <strong>&euro;
                            <?= number_format($productService->getSubtotalPrice() + 5.99, 2); ?>
                        </strong>
                    </li>
                    <?php
                }
                ?>
                </ul>
                <button class="btn btn-theme btn-lg btn-block text-white sticky-xl-top sticky-lg-top sticky-md-top"
                        type="submit" onclick="confirmPurchase()" style="top: 320px;">Confirm Purchase</button>
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
<footer class="text-center text-lg-start bg-white text-muted border-top">
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fa fa-keyboard-o me-3 text-secondary"></i>Clicktastic
                    </h6>
                    <p>Your favorite keyboards in one place.</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">LINKS</h6>
                    <p>
                        <a href="/" class="text-reset text-decoration-none">Home</a>
                    </p>
                    <p>
                        <a href="/shop/products" class="text-reset text-decoration-none">Products</a>
                    </p>
                    <p>
                        <a href="/cart/shoppingcart" class="text-reset text-decoration-none">Shopping Cart</a>
                    </p>
                    <p>
                        <a href="/account/account" class="text-reset text-decoration-none">Account</a>
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="fa fa-home me-3 text-secondary"></i>Haarlem, NL</p>
                    <p>
                        <i class="fa fa-envelope me-3 text-secondary"></i>clicktastic@info.com
                    </p>
                    <p><i class="fa fa-phone me-3 text-secondary"></i>+ 31 6 1234 5679</p>
                </div>
            </div>
        </div>
    </section>
</footer>
<script type="text/javascript" defer src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
