<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Checkout</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
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
                <div id="accountForm">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="firstName">First name</label>
                            <h5><strong><?php echo htmlspecialchars($user->getFirstName()) ?></strong></h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <h5><strong><?php echo htmlspecialchars($user->getLastName()) ?></strong></h5>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <h5><strong><?php echo htmlspecialchars($user->getEmail()) ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <h5><strong>
                            <?php
                                if (!empty($user->getPhoneNumber())) {
                                    echo htmlspecialchars($user->getPhoneNumber());
                                } else {
                                    echo "-";
                                }
                             ?></strong></h5>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Address information</h4>
                    <div class="mb-0">
                        <label for="address">Address</label>
                        <h5><strong>
                                <?php
                                if (!empty($user->getAddress())) {
                                    echo htmlspecialchars($user->getAddress());
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="address2"><span class="text-muted">Address 2 (Optional)</span></label>
                        <h5><strong>
                                <?php
                                if (!empty($user->getAddressOptional())) {
                                    echo htmlspecialchars($user->getAddressOptional());
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="mb-3">
                        <label for="citytown">City / Town</label>
                        <h5><strong>
                                <?php
                                if (!empty($user->getCity())) {
                                    echo htmlspecialchars($user->getCity());
                                } else {
                                    echo "-";
                                }
                                ?></strong></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="country">Country</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->getCountry())) {
                                        echo htmlspecialchars($user->getCountry());
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="stateprovince">State / Province</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->getState())) {
                                        echo htmlspecialchars($user->getState());
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <h5><strong>
                                    <?php
                                    if (!empty($user->getPostalCode())) {
                                        echo htmlspecialchars($user->getPostalCode());
                                    } else {
                                        echo "-";
                                    }
                                    ?></strong></h5>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <a href="/account/editaccount" class="btn btn-theme btn-lg btn-block text-white" type="submit" name="submit">
                        Edit information</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
