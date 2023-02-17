<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Keyboards to satisfy your typing needs.</title>
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
<?php include_once(__DIR__ . '/../navbar.php'); ?>
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
            <?= $pagination->createLinks(); ?>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>