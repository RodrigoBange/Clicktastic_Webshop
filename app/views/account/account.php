<?php
if (!isset($_SESSION['logged_in'])) {
    header("location: /login/login");
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
    <title>Checkout</title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
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
            <h2>Account overview</h2>
        </div>
        <div>
            <div>
                <h4 class="mb-3">Personal information</h4>
                <div id="accountForm">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="firstName">First name</label>
                            <h5><strong><?php echo htmlspecialchars($user->first_name) ?></strong></h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <h5><strong><?php echo htmlspecialchars($user->last_name) ?></strong></h5>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <h5><strong><?php echo htmlspecialchars($user->email) ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <h5><strong>
                            <?php
                                if (!empty($user->phone_number)) {
                                    echo htmlspecialchars($user->phone_number);
                                } else {
                                    echo "-";
                                }
                             ?></strong></h5>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Address information</h4>
                    <div class="mb-0">
                        <label for="address">Address</label>
                        <h5><strong>
                                <?php
                                if (!empty($user->address)) {
                                    echo htmlspecialchars($user->address);
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="address2"><span class="text-muted">Address 2 (Optional)</span></label>
                        <h5><strong>
                                <?php
                                if (!empty($user->address_optional)) {
                                    echo htmlspecialchars($user->address_optional);
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="citytown">City / Town</label>
                        <h5><strong>
                                <?php
                                if (!empty($user->city)) {
                                    echo htmlspecialchars($user->city);
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="country">Country</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->country)) {
                                        echo htmlspecialchars($user->country);
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="stateprovince">State / Province</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->state)) {
                                        echo htmlspecialchars($user->state);
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->postal_code)) {
                                        echo htmlspecialchars($user->postal_code);
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <a href="/account/editaccount" class="btn btn-theme btn-lg btn-block text-white" type="submit" name="submit">
                        Edit information</a>
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
