<?php
if (isset($_POST)) {
    $userInfo = array(
        'first_name' => $_POST['firstName'],
        'last_name' => $_POST['lastName'],
        'address' => $_POST['address'],
        'address_optional' => $_POST['address2'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'postal_code' => $_POST['zip'],
        'country' => $_POST['country'],
        'phone_number' => $_POST['phoneNumber'],
        'email' => $_SESSION['email']
    );

    // Update information
    $result = $userService->updateUser($userInfo);

    if ($result) {
        $_SESSION['name'] = $_POST['firstName'];
    }

    echo json_encode($result);
}
