<?php

require_once '../database.php';

function getTripsForCurrentUser($userId) {
    $result = mysql_query("SELECT destination FROM trip where user_id = ". $userId);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('destination' => $r['destination']);
    }
    return $rows;
}

function deleteTrip($trip_id) {
    //todo
}

function copyTrip($trip_id) {
    //todo
}