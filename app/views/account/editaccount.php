<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Checkout</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script type="text/javascript" src="../../js/address_autocomplete.js"></script>
    <script type="text/javascript" src="../../js/get_user_country.js" defer></script>
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
                        if (reply) {
                            window.location.assign("/account/account");
                        } else {
                            var warning = $('#warning');
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
<?php include_once(__DIR__ . '/../navbar.php'); ?>
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
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
