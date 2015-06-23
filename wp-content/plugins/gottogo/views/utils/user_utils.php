<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getAllRegisteredUsers() {
    $database = new Database();
    $connection = $database->getConnection();

    $query = "SELECT * FROM users WHERE role = 'user'";
    $result = mysqli_query($connection, $query);

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = array('id' => $r['id'], 'email' => $r['email'], 'fullname' => $r['fullname'], 'role' => $r['role']);
    }
    return $rows;
}
