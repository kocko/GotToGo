<?php

session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

function deleteUser() {
    if ($_POST['userId']) {
        $database = new Database();
        $user_id = $_POST['userId'];
        $query = sprintf("DELETE FROM `users` where `id` = %s", $user_id);
        $result = mysqli_query($database->getConnection(), $query);
        return $result ? 1 : 0;
    }
    return 0;
}

echo deleteUser();
