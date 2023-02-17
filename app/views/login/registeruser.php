<?php
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Check if email exists, return booleans as integers (JS reads the values as string)
    if (!$userService->userExists($_POST['email'])) {
        // Register user
        $registerSuccess = (int)$userService->registerUser(
            $_POST['email'],
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['password']
        );
        $emailExists = 0;
    } else {
        // Email already exists
        $registerSuccess = 0;
        $emailExists = 1;
    }
} else {
    $registerSuccess = 0;
    $emailExists = 0;
}

// Return variables
echo json_encode(array(
    "registerSuccess" => $registerSuccess,
    "emailExists" => $emailExists
));
