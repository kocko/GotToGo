<?php

require_once '../database.php';

function getTripsForCurrentUser($userId) {
    $result = mysql_query("SELECT id as tripId, destination as destination FROM trip where user_id = ". $userId);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('destination' => $r['destination'], 'id' => $r['tripId']);
    }
    return $rows;
}



function copyTrip($trip_id) {

}
