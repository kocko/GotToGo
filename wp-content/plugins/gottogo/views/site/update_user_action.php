<?php
session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

function update_user() {
    if (isset($_POST['user_id'])) {
        $user_id = sanitize_text_field($_POST['user_id']);
        $name = sanitize_text_field($_POST['fullname']);
        $password = sanitize_text_field($_POST['password']);

        $passwordSalted = md5($password);

        $sql = "UPDATE users SET password = '%s', fullname = '%s' WHERE id = " . $user_id;

        $query = sprintf($sql, mysql_real_escape_string($passwordSalted), mysql_real_escape_string($name));

        $result = mysql_query($query, $GLOBALS['connection']);
        if ($result) {
            $_SESSION['user']['fullname'] = $name;
            return 1;
        }
        return 0;
    }
}

echo update_user();
