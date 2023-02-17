<?php
if (!isset($_SESSION['logged_in'])) {
    header("location: /login/login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Checkout</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
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
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>