<?php

require_once '../database.php';

function checkEmail($email) {
    $email = mysql_real_escape_string($_POST['register_email']);

    $query = sprintf("SELECT count(email) as total FROM users WHERE email='%s'", mysql_real_escape_string($email));

    $result = mysql_query($query, $GLOBALS['connection']);

    $row = mysql_fetch_assoc($result);

    return $row['total'] == 0 ? 0 : 1;
}

$email = mysql_real_escape_string($_POST['register_email']);

echo checkEmail($email);
