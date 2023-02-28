// Remove all non-numeric characters from self
function onlyNumeric() {
    var $input = $('#inputQuantity');
    $input.val($input.val().replace(/\D/g, ''));

    // Input limit
    if ($input.val() > 10) {
        $input.val(10);
    } else if ($input.val() <= 0) {
        $input.val(1);
    }
}