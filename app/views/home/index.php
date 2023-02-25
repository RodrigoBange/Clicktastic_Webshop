<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Clicktastic, your favourite keyboards in one place.</title>
    <script type="text/javascript" src="../../js/add_product.js"></script>
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
<?php include_once(__DIR__ . '/../shop/newestproducts.php'); ?>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
