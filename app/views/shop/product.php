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
    <title>
        <?php
        if (isset($_GET['id'])) {
            try {
                $product = $productService->getProductById($_GET['id']);

                if ($product != null) {
                    echo $product->name;
                } else {
                    echo "Product not found.";
                }
            } catch (Exception $e) {
                echo "Product not found.";
            }
        }
        ?>
    </title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script>
        function addProduct($button_id) {
            // Get numbers of button ID
            var $id = $button_id.match(/\d/g).join("");
            var $price = document.getElementById("price").innerText.replace('€', '').replace('&euro;', '');
            var $quantity = document.getElementById("inputQuantity").value;
            var $cartcount = document.getElementById("cartcount");

            $.ajax({
                url: '/cart/addtocart',
                data: {product_id : $id, product_quantity : $quantity, product_price : $price},
                success: function(reply) {
                    $cartcount.textContent = reply;

                    // In case of input abuse
                    if ($quantity > 10) {
                        document.getElementById("inputQuantity").value = 10;
                    }
                },
                error: function(req, status, error) {
                    console.log( 'Something went wrong: ', status, error, req );
                }
            });
        }
    </script>
</head>
<body class="bg-light">
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
<section class="py-5 bg-white">
    <div class="container px-4 px-lg-5 my-5">
    <?php
        if (isset($_GET['id'])) {
            try {
                $product = $productService->getProductById($_GET['id']);
                if ($product != null) {
                ?>
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                           src="../../images/<?= $product->image ?>" alt="keyboard"></div>
                        <div class="col-md-6">
                            <div class="small mb-1">SKU: <?= $product->id ?></div>
                            <h1 class="display-5 fw-bolder"><?= $product->name ?></h1>
                            <div class="fs-5 mb-5">
                                <span id="price">&euro; <?= $product->price ?></span>
                            </div>
                            <p class="lead"><?= $product->description ?></p>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="number"
                                       value="1" min="1" max="10" style="max-width: 5rem" required>
                                <button class="btn btn-theme text-white flex-shrink-0" type="button"
                                        id="btn-add-<?= $product->id ?>" onclick="addProduct(this.id)">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    ?>
                    <h3>Product could not be found.</h3>
                    <?php
                }
            } catch (Exception $e) {
            ?>
                <h3>Product could not be found.</h3>
            <?php
            }
        } else {
        ?>
            <h3>Product could not be found.</h3>
        <?php
        }
    ?>
    </div>
</section>
<div class="container mt-5 mb-5 ">
    <div class="row">
        <h3>Other Products</h3>
    </div>
    <div class="row">
        <?php
        foreach ($products as $product) {
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card overflow-hidden">
                    <div class="bg-image overflow-hidden d-flex">
                        <a href="/shop/product?id=<?= $product->id ?>" class="flex-grow-1 d-flex justify-content-center">
                            <img src="../../images/<?= htmlspecialchars($product->image) ?>"
                                 class="w-auto hover-zoom mx-auto" alt="keyboard" style="height: 200px;"/>
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="/shop/product?id=<?= $product->id ?>"
                           class="card-title mb-1 text-decoration-none text-black">
                            <h5 class="card-title mb-1"><?= $product->name ?></h5>
                        </a>
                        <p class="opacity-75 badge bg-theme"><?= $product->company ?></p>
                        <h6 class="mb-3" id="price-<?= $product->id ?>">&euro;<?= $product->price ?></h6>
                        <button type="button" id="btn-add-<?= $product->id ?>" onclick="addProduct(this.id)"
                                class="btn btn-theme text-white">Add To Cart</button>
                        <a href="/shop/product?id=<?= $product->id ?>" class="btn btn-theme text-white">
                            More Info</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
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
                        <a href="#!" class="text-reset text-decoration-none">Home</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset text-decoration-none">Products</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset text-decoration-none">Shopping Cart</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset text-decoration-none">Account</a>
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
