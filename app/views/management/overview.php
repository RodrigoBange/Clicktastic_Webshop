<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Admin overview</title>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="page pt-5 pb-5 bg-light">
    <div class="container">
        <div class="pt-5">
            <h2>All orders</h2>
        </div>
        <div>
            <div>
                <?php
                foreach ($orders as $order) {
                    ?>
                    <h4 class="mb-3">Order #<?= htmlspecialchars($order->getId()) ?></h4>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <p class="mb-1">Order placed</p>
                            <h6><strong><?php
                                    $date = new DateTime(htmlspecialchars($order->getOrderDate()));
                                    echo $date->format('Y-m-d');
                                    ?></strong></h6>
                        </div>
                        <div class="col-md-2 mb-3">
                            <p class="mb-1">Total</p>
                            <h6><strong>&euro; <?= htmlspecialchars($order->getTotal()) ?></strong></h6>
                        </div>
                        <div class="col-md-2 mb-3">
                            <p class="mb-1">Shipped to</p>
                            <h6 class="mb-0"><strong><?= htmlspecialchars($order->getAddress()) . " " .
                                        htmlspecialchars($order->getAddressOptional())
                                    ?></strong></h6>
                            <h6 class="mb-0"><strong><?= htmlspecialchars($order->getPostalCode()) . ", " .
                                    htmlspecialchars($order->getCity()) . ", " .
                                    htmlspecialchars($order->getCountry())?></strong></h6>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-3 fw-bold">Products</p>
                        <?php
                        foreach ($order->getProducts() as $product) {
                            ?>
                            <a href="/shop/product?id=<?= htmlspecialchars($product->getId()) ?>"
                               class="list-group-item d-flex lh-condensed text-decoration-none mb-3">
                                <img class="w-25 border"
                                     src="../../images/<?= htmlspecialchars($product->getImage()) ?>" alt="keyboard">
                                <div class="col-sm-5 col-1 p-4 pt-0">
                                    <h5><strong><?= htmlspecialchars($product->getName()) ?></strong></h5>
                                    <h6>&euro; <?= number_format($product->getPrice(), 2) ?></h6>
                                    <small class="col-sm-2 col-12">Quantity:
                                        <?= $product->getQuantity() ?></small>
                                </div>
                            </a>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1">Expected Delivery Date</p>
                        <h6><strong><?php
                                $date = new DateTime(htmlspecialchars($order->getOrderDate()));
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
