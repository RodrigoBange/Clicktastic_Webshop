<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Oops! Something went wrong.</title>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="pt-5 pb-5 bg-light d-flex align-items-center justify-content-center" style="min-height: 500px;">
    <div class="d-flex justify-content-center p-5 flex-column align-items-center">
        <em class="fa fa-exclamation-triangle" style="font-size: 2em;"></em>
        <span class="pt-3 pb-3">Oops! It appears something has gone wrong. Please try again.</span>
        <a class="btn btn-theme text-white" href="/cart/confirmation">Return to overview</a>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
