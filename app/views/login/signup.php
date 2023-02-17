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
            $('#registerForm').submit(function(e) {
                e.preventDefault()

                $.ajax({
                    url: '/login/registeruser',
                    data: $(this).serialize(),
                    dataType: "json",
                    method: 'POST',
                    success: function(reply) {
                        displayRegisterModal(reply.registerSuccess, reply.emailExists);
                    },
                    error: function(req, status, error) {
                        displayRegisterModal(false, false);
                        console.log( 'Something went wrong: ', status, error, req );
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="modal fade in" id="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registration</h4>
                <button type="button" class="close btn btn-outline-dark" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal-message">You've been successfully registered!</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="/login/login" class="btn btn-theme btn-block text-white" id="modal-login">Log in</a>
                <button type="button" class="btn btn-theme btn-block text-white" id="modal-again"
                        aria-label="Close" onclick="closeModal();"><span aria-hidden="true">Try again</span></button>
            </div>
        </div>
    </div>
</div>
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
                <a href="/cart/shoppingcart" class="nav-item nav-link">
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
                            <form id="registerForm" method="post" action="#">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="signupFirstName">First name</label>
                                            <input type="text" id="signupFirstName" name="firstname"
                                                   class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="signupLastName">Last name</label>
                                            <input type="text" id="signupLastName" name="lastname" class="form-control"
                                                   required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="signupEmail">Email</label>
                                    <input type="email" id="signupEmail" name="email" class="form-control" required/>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="signupPassword">Password</label>
                                    <input type="password" id="signupPassword" name="password" class="form-control"
                                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                           title="Must contain at least
                                           one number, one uppercase and lowercase letter, and at least 8 or more
                                           characters." onkeyup="validPassword(this)" required/>
                                </div>
                                <div id="warning" class="collapse">
                                    <div class="alert alert-danger" role="alert">
                                        Password must contain at least:
                                        <ul>
                                            <li>1 <b>lowercase </b>letter</li>
                                            <li>1 <b>uppercase </b>letter</li>
                                            <li>1 <b>number</b></li>
                                            <li>1 <b>special </b>character</li>
                                            <li>A minimum of <b>8 characters</b></li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" id="signup-btn" name="signup"
                                        class="btn btn-theme btn-block text-white mb-3">Sign up</button>
                                <p>
                                    <a href="/login/login" class="text-reset text-decoration-none">
                                        Already have an account? <u>Click here to log in.</u>
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
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        LINKS
                    </h6>
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
<script type="text/javascript" defer src="../../js/register_user.js"></script>
</body>
</html>
