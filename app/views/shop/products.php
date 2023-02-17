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
    <title>Keyboards to satisfy your typing needs.</title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script>
        // Custom function to handle search and filter operations
        function searchFilter(page_num) {
            page_num = page_num ? page_num : 0;
            var keywords = $('#keywords').val();
            var filterBy = $('#filterBy').val();

            $.ajax({
                type: 'POST',
                url: '/shop/getData',
                data: 'page=' + page_num + '&keywords=' + keywords + '&filerBy=' + filterBy,
                success: function (html) {
                    $('#dataContainer').html(html);
                }
            });
        }

        function addProduct($button_id) {
            // Get numbers of button ID
            var $id = $button_id.match(/\d/g).join("");
            var $price = document.getElementById("price-" + $id).innerText.replace('€', '').replace('&euro;', '');
            var $quantity = 1;
            var $cartcount = document.getElementById("cartcount");

            $.ajax({
                url: '/cart/addtocart',
                data: {product_id : $id, product_quantity : $quantity, product_price : $price},
                success: function(reply) {
                    $cartcount.textContent = reply;
                },
                error: function(req, status, error) {
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
<header class="p-5 text-center bg-theme" style="margin-top: 60px;">
    <div class="text-white">
        <h1 class="mb-3">Clicktastic</h1>
        <h4 class="mb-3">Keyboards</h4>
    </div>
</header>
<div class="container">
    <div class="datalist-wrapper">
        <div class="search-panel">
            <div class="form-row">
                <div class="form-group col-md-6 mt-4">
                    <input type="text" class="form-control" id="keywords" placeholder="Type keywords..."
                           onkeyup="searchFilter();">
                </div>
            </div>
        </div>
        <div id="dataContainer" class="mt-4 mb-5">
            <div class="row">
                <?php
                if ($productResults > 0) {
                    foreach ($productResults as $product) {
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
                } else {
                    echo "No records found...";
                }
                ?>
            </div>
            <?php echo $pagination->createLinks(); ?>
        </div>
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
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        LINKS
                    </h6>
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
<?php

?>
