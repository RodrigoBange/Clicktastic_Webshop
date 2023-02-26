$(document).ready(function() {
    $('#updateForm').submit(function (e) {
        e.preventDefault()

        $.ajax({
            url: '/account/updateaccount',
            data: $(this).serialize(),
            dataType: "json",
            method: 'POST',
            success: function (reply) {
                var result = $.parseJSON(reply);
                if (reply === true) {
                    window.location.assign("/account/account");
                } else {
                    var warning = document.getElementById('warning');
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