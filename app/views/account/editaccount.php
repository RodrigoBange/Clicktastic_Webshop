<?php
if (!isset($_SESSION['logged_in'])) {
    header("location: /login/login");
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
    <title>Checkout</title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function (e) {
                e.preventDefault()

                $.ajax({
                    url: '/account/updateaccount',
                    data: $(this).serialize(),
                    dataType: "json",
                    method: 'POST',
                    success: function (reply) {
                        var $warning;
                        if (reply) {
                            window.location.assign("/account/account");
                        } else {
                            $warning = $('#warning');
                            if (warning.classList.contains('collapse')) {
                                warning.classList.remove('collapse');
                            }
                        }
                    },
                    error: function (req, status, error) {
                        console.log('Something went wrong: ', status, error, req);
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
<main class="page pt-5 pb-5 bg-light">
    <div class="container">
        <div class="pt-5">
            <h2>Account overview</h2>
        </div>
        <div>
            <div>
                <h4 class="mb-3">Personal information</h4>
                <form id="updateForm" method="post" action="#">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName"
                                   placeholder="" value="<?php echo htmlspecialchars($user->first_name)?>"
                                   name="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder=""
                                   value="<?php echo htmlspecialchars($user->last_name)?>"
                                   name="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email (Can't be changed)</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="<?php echo htmlspecialchars($user->email) ?>"
                               name="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number"
                               placeholder="+31 6 12345678" value="<?php
                                                                    if (!empty($user->phone_number)) {
                                                                        echo htmlspecialchars($user->phone_number);
                                                                    }
                                                                    ?>"
                               name="phoneNumber">
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Address information</h4>
                    <div class="mb-0">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address"
                               placeholder="Street address, P.O. box, company name" name="address"
                               value="<?php
                                       if (!empty($user->address)) {
                                           echo htmlspecialchars($user->address);
                                       }
                                       ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address2"><span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2"
                               placeholder="Apartment, suite, unit, building, floor, etc." name="address2"
                        value="<?php
                                if (!empty($user->phone_number)) {
                                    echo htmlspecialchars($user->address_optional);
                                }
                                ?>">
                    </div>
                    <div class="mb-3">
                        <label for="citytown">City / Town</label>
                        <input type="text" class="form-control" id="citytown" name="city"
                               value="<?php
                                       if (!empty($user->city)) {
                                           echo htmlspecialchars($user->city);
                                       }
                                       ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" name="country">
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="stateprovince">State / Province</label>
                            <input type="text" class="form-control" id="stateprovince" placeholder=""
                                   name="state"
                                   value="<?php
                                           if (!empty($user->state)) {
                                               echo htmlspecialchars($user->state);
                                           }
                                           ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" name="zip"
                                   value="<?php
                                           if (!empty($user->postal_code)) {
                                               echo htmlspecialchars($user->postal_code);
                                           }
                                           ?>">
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-theme btn-lg btn-block text-white" type="submit" name="update">
                        Update information</button>
                    <div id="warning" class="collapse">
                        <div class="alert alert-danger" role="alert">
                            An issue occurred, please try again.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
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
<script type="text/javascript" src="../../js/address_autocomplete.js"></script>
<Script type="text/javascript" defer>
    <?php
    if (isset($user->country)) {
    ?>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function timer() {
            await sleep(1000);
            setDefaultCountry();
        }

        function setDefaultCountry() {
            var country = "<?php echo htmlspecialchars($user->country) ?>";
            $('#country').val(country);
        }

        timer();
    <?php
    }
    ?>
</Script>
</body>
</html>
