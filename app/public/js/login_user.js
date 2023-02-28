$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: '/login/loginuser',
            data: $(this).serialize(),
            dataType: "json",
            method: 'POST',
            success: function(reply) {
                var result = $.parseJSON(reply);
                if (result === true) {
                    window.location.assign("/shop/products");
                } else {
                    var warning = document.getElementById('warning');
                    if (warning.classList.contains('collapse')) {
                        warning.classList.remove('collapse');
                    }
                }
            },
            error: function(req, status, error) {
                console.log( 'Something went wrong: ', status, error, req );
            }
        });
    });
});