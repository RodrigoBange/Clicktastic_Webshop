function confirmPurchase(userinfo) {
    $.ajax({
        type: 'POST',
        url: '/cart/processpurchase',
        data: {
            data: userinfo
    },
    success: function(reply) {
        // If all good, navigate to success screen
        console.log("success" + reply)
    },
    error: function(req, status, error) {
        // Display error
        console.log( 'Something went wrong: ', status, error, req );
    }
});
}