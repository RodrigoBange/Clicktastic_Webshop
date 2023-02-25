<?php
    if (isset($_SESSION['logged_in'])) {
        header("location: /account/account");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Log in.</title>
    <script type="text/javascript" src="../../js/login_user.js"></script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
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
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
