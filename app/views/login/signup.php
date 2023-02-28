<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Create an account.</title>
    <script type="text/javascript" src="../../js/signup_user.js" defer></script>
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
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
