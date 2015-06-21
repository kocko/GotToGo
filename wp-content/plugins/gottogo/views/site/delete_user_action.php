<?php

session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

function deleteUser() {
    if ($_POST['userId']) {
        $user_id = $_POST['userId'];
        $query = sprintf("DELETE FROM `users` where `id` = %s", mysql_real_escape_string($user_id));
        $result = mysql_query($query);
        return $result ? 1 : 0;
    }
    return 0;
}

echo deleteUser();
