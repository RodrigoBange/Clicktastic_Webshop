<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Clicktastic, your favourite keyboards in one place.</title>
    <script>
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
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<header class="p-5 text-center bg-theme" style="margin-top: 60px;">
    <div class="text-white">
        <h1 class="mb-3">Clicktastic</h1>
        <h4 class="mb-3">All your keyboard needs in one place</h4>
        <a class="btn btn-outline-light btn-lg" href="/shop/products">Shop now</a>
    </div>
</header>
<div class="container mt-5 mb-5">
    <div class="row">
        <h3>Newest Products</h3>
    </div>
    <div class="row">
        <?php
        if ($newestProducts != null)
        {
            foreach ($newestProducts as $product) {
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card overflow-hidden h-100">
                    <div class="bg-image overflow-hidden d-flex">
                        <a href="/shop/product?id=<?= $product->id ?>" class="flex-grow-1 d-flex justify-content-center">
                            <img src="../../images/<?= htmlspecialchars($product->image) ?>"
                                 class="w-auto hover-zoom mx-auto" alt="keyboard" style="height: 200px;"/>
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="/shop/product?id=<?= $product->id ?>"
                           class="card-title mb-1 text-decoration-none text-black">
                            <h5 class="card-title mb-1"><?= htmlspecialchars($product->name) ?></h5>
                        </a>
                        <p class="opacity-75 badge bg-theme"><?= htmlspecialchars($product->company) ?></p>
                        <h6 class="mb-3" id="price-<?= $product->id ?>">&euro;<?= htmlspecialchars($product->price) ?></h6>
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
            echo "Oops! No products were found.";
        }
        ?>
    </div>
</div>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
