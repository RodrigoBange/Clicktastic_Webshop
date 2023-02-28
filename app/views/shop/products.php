<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Keyboards to satisfy your typing needs.</title>
    <script defer type="text/javascript" src="../../js/filter_products.js"></script>
    <script type="text/javascript" src="../../js/add_product.js"></script>
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
                    <label for="keywords"><strong>Enter your keywords</strong> (Separate by spaces)</label>
                    <input type="text" class="form-control" id="keywords" placeholder="Keywords...">
                </div>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div id="filters" class="container p-0" style="max-width: 200px;">
                <div id="brand-filters" class="container p-0">
                    <p class="pt-4 pb-0 mb-1 fw-bold">Brands</p>
                    <?php
                    if ($companies != null) {
                        foreach ($companies as $company) {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $company[0] ?>" name="brand"
                                       onclick="checkBoxChanged()">
                                <label class="form-check-label" for="brand">
                                    <?= $company[0] ?>
                                </label>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div id="dataContainer" class="mt-4 mb-5 container">
                <div class="row">
                    <?php
                    if ($productResults > 0) {
                        foreach ($productResults as $product) {
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card overflow-hidden h-100">
                                    <div class="bg-image overflow-hidden d-flex">
                                        <a href="/shop/product?id=<?= $product->getId() ?>" class="flex-grow-1 d-flex justify-content-center">
                                            <img src="../../images/<?= htmlspecialchars($product->getImage()) ?>"
                                                 class="w-auto hover-zoom mx-auto" alt="keyboard" style="height: 200px;"/>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <a href="/shop/product?id=<?= $product->getId() ?>"
                                           class="card-title mb-1 text-decoration-none text-black">
                                            <h5 class="card-title mb-1"><?= $product->getName() ?></h5>
                                        </a>
                                        <p class="opacity-75 badge bg-theme"><?= $product->getCompany() ?></p>
                                        <h6 class="mb-3" id="price-<?= $product->getId() ?>">&euro;<?= $product->getPrice() ?></h6>
                                        <button type="button" id="btn-add-<?= $product->getId() ?>" onclick="add_product(this.id)"
                                                class="btn btn-theme text-white">Add To Cart</button>
                                        <a href="/shop/product?id=<?= $product->getId() ?>" class="btn btn-theme text-white">
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
</div>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>