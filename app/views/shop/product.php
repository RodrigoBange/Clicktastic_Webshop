<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>
        <?php
        if ($product != null) {
            echo htmlspecialchars($product->getName());
        } else {
            echo "Product not found.";
        }
        ?>
    </title>
    <script type="text/javascript" src="../../js/add_product.js"></script>
    <script type="text/javascript" src="../../js/numeric_only_input.js"></script>
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
                                       src="../../images/<?= htmlspecialchars($product->getImage()) ?>" alt="keyboard"></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: <?= $product->getId() ?></div>
                <h1 class="display-5 fw-bolder"><?= htmlspecialchars($product->getName()) ?></h1>
                <div class="fs-5 mb-5">
                    <span id="price">&euro; <?= htmlspecialchars($product->getPrice()) ?></span>
                </div>
                <p class="lead"><?= htmlspecialchars($product->getDescription()) ?></p>
                <p>A maximum of 10 of this item is allowed per order.</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="number"
                           value="1" min="1" max="10" style="max-width: 5rem" onchange="onlyNumeric(this)" required>
                    <button class="btn btn-theme text-white flex-shrink-0" type="button"
                            id="btn-add-<?= $product->getId() ?>" onclick="addProductWithQuantity(this.id)">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
        <div class="container pt-5">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" style="width: 20%;">Specifications</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Product name</th>
                    <td class="flex-fill"><?= htmlspecialchars($product->getName()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Company</th>
                    <td><?= htmlspecialchars($product->getCompany()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Layout</th>
                    <td><?= htmlspecialchars($product->getLayout()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Size</th>
                    <td><?= htmlspecialchars($product->getSize()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Amount of keys</th>
                    <td><?= htmlspecialchars($product->getAmountKeys()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Backlit</th>
                    <td><?= htmlspecialchars($product->getBacklit()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Color</th>
                    <td><?= htmlspecialchars($product->getColor()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Material</th>
                    <td><?= htmlspecialchars($product->getMaterial()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Switches</th>
                    <td><?= htmlspecialchars($product->getSwitches()) ?></td>
                </tr>
                <tr>
                    <th scope="row">Hot-swappable</th>
                    <td><?= htmlspecialchars($product->isHotswap() ? 'Yes' : 'No') ?></td>
                </tr>
                </tbody>
            </table>
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
