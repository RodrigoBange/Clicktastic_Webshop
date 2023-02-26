function toggleShipping(checkbox) {
    var shippingForm = document.getElementById("shipping-diff");

    if (checkbox.checked) { // Hide extra form
        if (!shippingForm.classList.contains('collapse')) {
            shippingForm.classList.add('collapse');

            // Disable elements required
            document.getElementById('firstNameShip').disabled = true;
            document.getElementById('lastNameShip').disabled = true;
            document.getElementById('addressShip').disabled = true;
            document.getElementById('citytownShip').disabled = true;
            document.getElementById('countryShip').disabled = true;
            document.getElementById('stateprovinceShip').disabled = true;
            document.getElementById('zipShip').disabled = true;

        }
    } else { // Display extra form
        if (shippingForm.classList.contains('collapse')) {
            shippingForm.classList.remove('collapse');

            // Disable elements required
            document.getElementById('firstNameShip').disabled = false;
            document.getElementById('lastNameShip').disabled = false;
            document.getElementById('addressShip').disabled = false;
            document.getElementById('citytownShip').disabled = false;
            document.getElementById('countryShip').disabled = false;
            document.getElementById('stateprovinceShip').disabled = false;
            document.getElementById('zipShip').disabled = false;
        }
    }
}

function togglePayPal(radioButton) {
    var ccField = document.getElementById('ccField');
    var paypalField = document.getElementById('paypalField');

    if (radioButton.id === "paypal" && radioButton.checked) { // Display PayPal field
        if (paypalField.classList.contains('collapse')) {
            paypalField.classList.remove('collapse');
            ccField.classList.add('collapse');

            // Disable elements required
            document.getElementById('cc-name').disabled = true;
            document.getElementById('cc-number').disabled = true;
            document.getElementById('cc-expiration').disabled = true;
            document.getElementById('cc-cvv').disabled = true;

            // Enable elements required
            document.getElementById('paypal-email').disabled = false;
        }
    } else { // Display credit/debit fields
        if (!paypalField.classList.contains('collapse')) {
            paypalField.classList.add('collapse');
            ccField.classList.remove('collapse');

            // Disable elements required
            document.getElementById('paypal-email').disabled = true;

            // Enable elements required
            document.getElementById('cc-name').disabled = false;
            document.getElementById('cc-number').disabled = false;
            document.getElementById('cc-expiration').disabled = false;
            document.getElementById('cc-cvv').disabled = false;
        }
    }
}