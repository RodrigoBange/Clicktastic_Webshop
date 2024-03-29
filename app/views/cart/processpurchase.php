<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Processing order...</title>
    <script type="text/javascript" src="../../js/confirm_purchase.js" defer></script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="pt-5 pb-5 bg-light d-flex align-items-center justify-content-center" style="min-height: 500px;">
    <div class="d-flex justify-content-center p-5 flex-column align-items-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        </div>
        <span class="pt-3">Processing your order...</span>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>