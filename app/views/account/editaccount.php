<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Checkout</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script type="text/javascript" src="../../js/address_autocomplete.js" defer></script>
    <script type="text/javascript" src="../../js/get_user_country.js" defer></script>
    <script type="text/javascript" src="../../js/update_account.js" defer></script>
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
                                   placeholder="" value="<?= htmlspecialchars($user->getFirstName())?>"
                                   name="firstName" pattern="^[a-zA-Z][\sa-zA-Z]*" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder=""
                                   value="<?= htmlspecialchars($user->getLastName())?>"
                                   name="lastName" pattern="^[a-zA-Z][\sa-zA-Z]*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email (Can't be changed)</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="<?= htmlspecialchars($user->getEmail()) ?>"
                               name="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" class="form-control" id="phone_number"
                               placeholder="+31 6 12345678" value="<?php
                                                                    if (!empty($user->getPhoneNumber())) {
                                                                        echo htmlspecialchars($user->getPhoneNumber());
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
                                       if (!empty($user->getAddress())) {
                                           echo htmlspecialchars($user->getAddress());
                                       }
                                       ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address2"><span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2"
                               placeholder="Apartment, suite, unit, building, floor, etc." name="address2"
                        value="<?php
                                if (!empty($user->getPhoneNumber())) {
                                    echo htmlspecialchars($user->getAddressOptional());
                                }
                                ?>">
                    </div>
                    <div class="mb-3">
                        <label for="citytown">City / Town</label>
                        <input type="text" class="form-control" id="citytown" name="city" pattern="^[a-zA-Z][\sa-zA-Z]*"
                               value="<?php
                                       if (!empty($user->getCity())) {
                                           echo htmlspecialchars($user->getCity());
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
                                   name="state" pattern="^[a-zA-Z][\sa-zA-Z]*"
                                   value="<?php
                                           if (!empty($user->getState())) {
                                               echo htmlspecialchars($user->getState());
                                           }
                                           ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" name="zip"
                                   value="<?php
                                           if (!empty($user->getPostalCode())) {
                                               echo htmlspecialchars($user->getPostalCode());
                                           }
                                           ?>" >
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-theme btn-lg btn-block text-white" type="submit" name="update">
                        Update information</button>
                    <div id="warning" class="collapse mt-4">
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
