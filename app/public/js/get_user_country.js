// Wait before executing autofill of country
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function timer() {
    await sleep(1000);
    setDefaultCountry();
}

function setDefaultCountry() {
    $.ajax({
        url: '/account/getcountry',
        success: function(reply) {
            $country = JSON.parse(reply);
            if ($country != null) {
                $('#country').val($country);
            }
        }
    });
}

timer();