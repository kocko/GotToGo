<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getAllRegisteredUsers() {
    $result = mysql_query("SELECT * FROM users WHERE role = 'user'");
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('id' => $r['id'], 'email' => $r['email'], 'fullname' => $r['fullname']);
    }
    return $rows;
}
