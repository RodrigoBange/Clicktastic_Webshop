<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>
        <?php
        if ($product != null) {
            echo htmlspecialchars($product->name);
        } else {
            echo "Product not found.";
        }
        ?>
    </title>
    <script type="text/javascript" src="../../js/add_product.js"></script>
</head>
<body class="bg-light">
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<section class="py-5 bg-white">
    <div class="container px-4 px-lg-5 my-5">
    <?php
    if ($product != null) {
    ?>
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                       src="../../images/<?= htmlspecialchars($product->image) ?>" alt="keyboard"></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: <?= $product->id ?></div>
                <h1 class="display-5 fw-bolder"><?= htmlspecialchars($product->name) ?></h1>
                <div class="fs-5 mb-5">
                    <span id="price">&euro; <?= htmlspecialchars($product->price) ?></span>
                </div>
                <p class="lead"><?= htmlspecialchars($product->description) ?></p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="number"
                           value="1" min="1" max="10" style="max-width: 5rem" required>
                    <button class="btn btn-theme text-white flex-shrink-0" type="button"
                            id="btn-add-<?= $product->id ?>" onclick="addProductWithQuantity(this.id)">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    <?php
    } else {
        ?>
        <h3>Sorry, we could not find this product!</h3>
        <?php
    }
    ?>
    </div>
</section>
<?php include_once(__DIR__ . '/../shop/newestproducts.php'); ?>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
