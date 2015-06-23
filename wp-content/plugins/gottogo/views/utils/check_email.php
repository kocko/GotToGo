<?php

require_once '../database.php';

function checkEmail() {
    $database = new Database();
    $connection = $database->getConnection();

    $email = mysqli_real_escape_string($connection, $_POST['register_email']);

    $query = sprintf("SELECT count(email) as total FROM users WHERE email='%s'", $email);

    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($result);

    return $row['total'] == 0 ? 0 : 1;
}

echo checkEmail();
