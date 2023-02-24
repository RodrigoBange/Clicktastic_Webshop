<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Keyboards to satisfy your typing needs.</title>
    <script defer type="text/javascript" src="../../js/filterproducts.js"></script>
    <script type="text/javascript" src="../../js/addproduct.js"></script>
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
                    <input type="text" class="form-control" id="keywords" placeholder="Type keywords...">
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