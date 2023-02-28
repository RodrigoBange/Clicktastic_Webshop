<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Success!</title>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="pt-5 pb-5 bg-light d-flex align-items-center justify-content-center" style="min-height: 500px;">
    <div class="d-flex justify-content-center p-5 flex-column align-items-center">
        <em class="fa fa-check text-success" style="font-size: 2em;"></em>
        <span class="pt-3 pb-3">Your order has been successfully processed!</span>
        <a class="btn btn-theme text-white" href="/shop/products">Continue browsing</a>
        <span class="p-2">or</span>
        <a class="btn btn-theme text-white" href="/account/orders">Check your orders</a>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>