<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once(__DIR__ . '/../generalheadinfo.php'); ?>
    <title>Checkout</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script type="text/javascript" src="../../js/toggle_checkout_options.js"></script>
    <script type="text/javascript" src="../../js/cleave_settings.js" defer></script>
    <script type="text/javascript" src="../../js/address_autocomplete.js" defer></script>
    <script type="text/javascript" src="../../js/get_user_country.js" defer></script>
</head>
<body>
<?php include_once(__DIR__ . '/../navbar.php'); ?>
<main class="page pt-5 pb-5 bg-light">
    <div class="container">
        <div class="pt-5">
            <h2>Checkout</h2>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3 sticky-xl-top sticky-lg-top sticky-md-top" style="top: 70px;">
                    <span class="text-muted">Your items</span>
                </h4>
                <?php
                if (!empty($cartProducts)) {
                ?>
                <ul class="list-group mb-3 sticky-xl-top sticky-lg-top sticky-md-top" style="top: 115px;">
                <?php
                    foreach ($cartProducts as $cartProduct) {
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $cartProduct->name ?></h6>
                                <small class="text-muted">Quantity:
                                    <?= $_SESSION['cart'][$cartProduct->id]['product_quantity'] ?>x
                                </small>
                                <small class="text-muted">&euro; <?= $cartProduct->price ?></small>
                            </div>
                            <span class="text-muted">&euro;
                                <?= number_format($cartProduct->price * $_SESSION['cart'][$cartProduct->id]['product_quantity'], 2);
                                ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Shipping</span>
                        <span class="text-muted">&euro; 5.99</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Euro)</span>
                        <strong>&euro;
                            <?= $subtotal ?>
                        </strong>
                    </li>
                    <?php
                }
                ?>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form id="checkout-form" method="post" action="/cart/confirmation">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder=""
                                   value="<?php
                                            if (!empty ($user->first_name)) {
                                                echo htmlspecialchars($user->first_name);
                                            } ?>"
                                   name="billingFirstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder=""
                                   value="<?php
                                            if (!empty ($user->last_name)) {
                                                echo htmlspecialchars($user->last_name);
                                            } ?>"
                                   name="billingLastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com"
                               name="billingEmail" value="<?php
                                                            if (!empty($user->email)) {
                                                                echo htmlspecialchars($user->email);
                                                            } ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" placeholder="+31 6 12345678"
                               name="billingPhoneNumber" value="<?php
                                                    if (!empty($user->phone_number)) {
                                                        echo htmlspecialchars($user->phone_number);
                                                    }
                                                    ?>"
                               required>
                    </div>
                    <div class="mb-0">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address"
                               placeholder="Street address, P.O. box, company name" name="billingAddress"
                               value="<?php
                               if (!empty($user->address)) {
                                   echo htmlspecialchars($user->address);
                               }
                               ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address2"><span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2"
                               placeholder="Apartment, suite, unit, building, floor, etc." name="billingAddress2"
                               value="<?php
                               if (!empty($user->address_optional)) {
                                   echo htmlspecialchars($user->address_optional);
                               }
                               ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="citytown">City / Town</label>
                        <input type="text" class="form-control" id="citytown" name="billingCity"
                               value="<?php
                               if (!empty($user->city)) {
                                   echo htmlspecialchars($user->city);
                               }
                               ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" name="billingCountry" required>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="stateprovince">State / Province</label>
                            <input type="text" class="form-control" id="stateprovince" placeholder=""
                                   name="billingState" value="<?php
                            if (!empty($user->state)) {
                                echo htmlspecialchars($user->state);
                            }
                            ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" name="billingZip"
                                   value="<?php
                                   if (!empty($user->postal_code)) {
                                       echo htmlspecialchars($user->postal_code);
                                   }
                                   ?>" required>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input id="checkbox-shipping" type="checkbox" class="custom-control-input" id="same-address"
                               checked onchange="toggleShipping(this);">
                        <label class="custom-control-label" for="same-address">
                            Shipping address is the same as my billing address</label>
                    </div>
                    <hr class="mb-4">
                    <div id="shipping-diff" class="collapse">
                        <h4 class="mb-3">Shipping address</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstNameShip">First name</label>
                                <input type="text" class="form-control" id="firstNameShip" placeholder="" value=""
                                       disabled="disabled" name="shippingFirstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastNameShip">Last name</label>
                                <input type="text" class="form-control" id="lastNameShip" placeholder="" value=""
                                       disabled="disabled" name="shippingLastName" required>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label for="addressShip">Address</label>
                            <input type="text" class="form-control" id="addressShip"
                                   placeholder="Street address, P.O. box, company name" disabled="disabled"
                                   name="shippingAddress" required>
                        </div>
                        <div class="mb-3">
                            <label for="address2Ship"><span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2Ship"
                                   placeholder="Apartment, suite, unit, building, floor, etc." name="shippingAddress2">
                        </div>
                        <div class="mb-3">
                            <label for="citytownShip">City / Town</label>
                            <input type="text" class="form-control" id="citytownShip" disabled="disabled"
                                   name="shippingCity" required>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="countryShip">Country</label>
                                <select class="custom-select d-block w-100" id="countryShip" disabled="disabled"
                                        name="shippingCountry" required>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="stateprovinceShip">State / Province</label>
                                <input type="text" class="form-control" id="stateprovinceShip" placeholder=""
                                       disabled="disabled" name="shippingState" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zipShip">Zip</label>
                                <input type="text" class="form-control" id="zipShip" placeholder=""
                                       disabled="disabled" name="shippingZip" required>
                            </div>
                        </div>
                        <hr class="mb-4">
                    </div>
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" value="creditCard" type="radio"
                                   class="custom-control-input" checked="" onchange="togglePayPal(this)">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" value="debitCard"
                                   class="custom-control-input" onchange="togglePayPal(this)">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" value="paypal"
                                   class="custom-control-input" onchange="togglePayPal(this)">
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div id="ccField">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder=""
                                       name="cardName" required>
                                <small class="text-muted">Full name as displayed on card</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder=""
                                       name="cardNumber" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY"
                                       name="cardExpiration" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="XXX"
                                       name="cardCVV" required>
                            </div>
                        </div>
                    </div>
                    <div class="row collapse" id="paypalField">
                        <div class="col-md-6 mb-3">
                            <label for="paypal-email">Email</label>
                            <input type="email" class="form-control" id="paypal-email" placeholder="you@example.com"
                                   disabled="disabled" name="paypalEmail" required>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-theme btn-lg btn-block text-white" type="submit" name="submit">
                        Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
</body>
</html>
