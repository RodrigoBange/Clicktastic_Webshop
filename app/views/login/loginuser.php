<?php
$result = "0";
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Attempt to log in user
    if ($userService->loginUser($_POST['email'], $_POST['password'])) {
        // Success
        $result = "1";

        // Set email to session

    }
}
// Return result
echo json_encode($result);
