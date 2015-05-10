<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function check_email_and_send_new_password($email) {
    $newPassword = generate_new_password();

    $newPasswordSalted = md5($newPassword);

    $updateQuery = sprintf("UPDATE users set password = '%s' WHERE email = '%s'",
                            mysql_real_escape_string($newPasswordSalted), mysql_real_escape_string($email));

    $result = mysql_query($updateQuery, $GLOBALS['connection']);
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

$email = mysql_real_escape_string($_POST['forgotten_password_email']);

echo check_email_and_send_new_password($email);