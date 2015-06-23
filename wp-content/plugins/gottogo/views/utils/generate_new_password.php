<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function check_email_and_send_new_password() {
    $database = new Database();
    $connection =  $database->getConnection();

    $email = mysqli_real_escape_string($connection, $_POST['forgotten_password_email']);

    $newPassword = generate_new_password();

    $newPasswordSalted = md5($newPassword);

    $updateQuery = sprintf("UPDATE users set password = '%s' WHERE email = '%s'",
                            mysqli_real_escape_string($connection, $newPasswordSalted),
                            mysqli_real_escape_string($connection, $email));

    $result = mysqli_query($connection, $updateQuery);

    if ($result) {
        wp_mail($email, "New password for Gottoto", "Your new password is: " . $newPassword , null, null);
        return "Success";
    } else {
        return "Failure";
    }
}

function generate_new_password($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

echo check_email_and_send_new_password();
