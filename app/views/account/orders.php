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
            <h2>Your orders</h2>
        </div>
        <div>
            <div>
            <?php
                foreach ($orders as $order) {
                ?>
                <h4 class="mb-3">Order #<?= htmlspecialchars($order->id); ?></h4>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="firstName">Order placed</label>
                            <h6><strong><?php
                                    $date = new DateTime(htmlspecialchars($order->order_date));
                                    echo $date->format('Y-m-d');
                                    ?></strong></h6>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="lastName">Total</label>
                            <h6><strong>&euro;<?php echo htmlspecialchars($order->total) ?></strong></h6>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="lastName">Shipped to</label>
                            <h6><strong><?php
                                    echo htmlspecialchars($user->first_name) . " " . htmlspecialchars($user->last_name)
                                    ?></strong></h6>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3">Products</label>
                        <?php
                        $count = 0;
                        foreach ($order->products as $product) {
                            foreach ($product as $item) {
                            ?>
                            <a href="/shop/product?id=<?php echo htmlspecialchars($item->id) ?>"
                               class="list-group-item d-flex lh-condensed text-decoration-none mb-3">
                                <img class="w-25 border"
                                     src="<?php echo htmlspecialchars($item->image) ?>" alt="keyboard">
                                <div class="col-sm-5 col-1 p-4 pt-0">
                                    <h5><strong><?php echo htmlspecialchars($item->name) ?></strong></h5>
                                    <h6>&euro;<?php echo htmlspecialchars($item->price) ?></h6>
                                    <small class="col-sm-2 col-12">Quantity:
                                        <?php echo htmlspecialchars($item->quantity) ?></small>
                                </div>
                            </a>
                        <?php
                        $count += 1;
                        }
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="email">Delivery Date</label>
                        <h6><strong><?php
                                $date = new DateTime(htmlspecialchars($order->order_date));
                                echo date('Y-m-d', strtotime($date->format('Y-m-d') . '+ 7 days'));
                                ?></strong></h6>
                    </div>
                    <hr class="mb-4">
                <?php
                }
            ?>
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
