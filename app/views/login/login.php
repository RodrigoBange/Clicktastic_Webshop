<?php
    if (isset($_SESSION['logged_in'])) {
        header("location: /account/account");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    <!--Delete the below line later. Only used for auto complete temporarily-->
    <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Create an account.</title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault()

                $.ajax({
                    url: '/login/loginuser',
                    data: $(this).serialize(),
                    dataType: "json",
                    method: 'POST',
                    success: function(reply) {
                        var $warning;
                        if (reply) {
                            window.location.assign("/shop/products");
                        } else {
                            $warning = $('#warning');
                            if (warning.classList.contains('collapse')) {
                                warning.classList.remove('collapse');
                            }
                        }
                    },
                    error: function(req, status, error) {
                        console.log( 'Something went wrong: ', status, error, req );
                    }
                });
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom fixed-top">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img src="images/logo.svg" height="28" alt="Clicktastic">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="/shop/products" class="nav-item nav-link">Shop</a>
                <?php
                $navFunc->management();
                ?>
            </div>
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-item nav-link">
                    <i class="fa fa-shopping-basket"></i>
                    <span id="cartcount">
                        <?php
                        echo $navFunc->getCount();
                        ?>
                    </span>
                </a>
                <?php
                $navFunc->displayUser();
                ?>
            </div>
        </div>
    </div>
</nav>
<section class="pt-5">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start bg-theme">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">Start your<br/>
                        <span class="text-white">typing adventure</span>
                    </h1>
                    <p class="text-white">
                        Improve your shopping experience by creating an account! <br/>
                        Get an overview of your orders and save time by having your details filled in automatically.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form id="loginForm" method="post" action="#">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="signupUsername">Email</label>
                                    <input type="email" id="signupUsername" class="form-control"
                                           name="email" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="signupPassword">Password</label>
                                    <input type="password" id="signupPassword" class="form-control"
                                           name="password" required/>
                                </div>
                                <div id="warning" class="collapse">
                                    <div class="alert alert-danger" role="alert">
                                        Invalid credentials. Please try again.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-theme btn-block text-white mb-3"
                                name="login">Log in</button>
                                <p>
                                    <a href="/login/signup" class="text-reset text-decoration-none">
                                        Not a member yet? <u>Click here to sign up!</u>
                                    </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="text-center text-lg-start bg-white text-muted border-top">
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fa fa-keyboard-o me-3 text-secondary"></i>Clicktastic
                    </h6>
                    <p>Your favorite keyboards in one place.</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">LINKS</h6>
                    <p>
                        <a href="/" class="text-reset text-decoration-none">Home</a>
                    </p>
                    <p>
                        <a href="/shop/products" class="text-reset text-decoration-none">Products</a>
                    </p>
                    <p>
                        <a href="/cart/shoppingcart" class="text-reset text-decoration-none">Shopping Cart</a>
                    </p>
                    <p>
                        <a href="/account/account" class="text-reset text-decoration-none">Account</a>
                    </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="fa fa-home me-3 text-secondary"></i>Haarlem, NL</p>
                    <p>
                        <i class="fa fa-envelope me-3 text-secondary"></i>clicktastic@info.com
                    </p>
                    <p><i class="fa fa-phone me-3 text-secondary"></i>+ 31 6 1234 5679</p>
                </div>
            </div>
        </div>
    </section>
</footer>
<script type="text/javascript" defer src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
