var modal = new bootstrap.Modal(document.getElementById("modal"));
var modalMessage = document.getElementById("modal-message");
var modalLogin = document.getElementById("modal-login");
var modalAgain = document.getElementById("modal-again");
var warning = document.getElementById('warning');

/**
 * Opens AJAX connection on form submit register user and display result
 */
$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: '/login/signupuser',
            data: $(this).serialize(),
            dataType: "json",
            method: 'POST',
            success: function(reply) {
                displayRegisterModal(reply.registerSuccess, reply.emailExists);
            },
            error: function(req, status, error) {
                displayRegisterModal(false, false);
                console.log( 'Something went wrong: ', status, error, req );
            }
        });
    });
});

/**
 * Checks if the registration password is valid and displays a warning message
 * @param passwordField The password input field
 */
function validPassword(passwordField) {
    if (passwordField.value) {
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$/.test(passwordField.value)) {
            warning.classList.add("collapse");
        }
        else {
            warning.classList.remove("collapse");
        }
    }
    else {
        warning.classList.add("collapse");
    }
}

/**
 * Displays the modal with message regarding the registration process.
 * @param success bool if registration was successful.
 * @param emailExists bool if email exists already.
 */
function displayRegisterModal(success, emailExists) {
    // Remove collapses if exists
    if (modalLogin.classList.contains("collapse")) { modalLogin.classList.remove("collapse"); }
    if (modalAgain.classList.contains("collapse")) { modalAgain.classList.remove("collapse"); }

    // Set up modal
    if (success && !emailExists) {
        modalMessage.textContent = "You've been successfully registered!";
        modalAgain.classList.add("collapse");
    } else if (!success && !emailExists) {
        modalMessage.textContent = "Oops! An error occurred while trying to register you. Please try again.";
        modalLogin.classList.add("collapse");
    } else {
        modalMessage.textContent = "This email is already in use. Please try again.";
        modalLogin.classList.add("collapse");
    }
    // Display  modal
    modal.show();
}

/**
 * Closes the registration modal.
 */
function closeModal() {
    modal.hide();
}
