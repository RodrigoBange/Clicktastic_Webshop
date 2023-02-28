// Wait before executing autofill of country
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function timer() {
    await sleep(3000);
    process();
}

function process() {
    $.ajax({
        url: '/cart/processment',
    success: function(reply) {
        var result = JSON.parse(reply);

        if (result === true) // Purchase successful
        {
            window.location.assign("/cart/paymentsuccess");
        } else { // Purchase failed
            window.location.assign("/cart/paymentfailure");
        }
    },
    error: function(req, status, error) {
        // Display error
        console.log( 'Something went wrong: ', status, error, req );
    }
});
}

timer();