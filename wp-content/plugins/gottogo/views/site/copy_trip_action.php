<?php

session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

require_once '../utils/trip_utils.php';

function makeACopyOfATrip() {
    if ($_POST['tripId']) {
        $tripId = $_POST['tripId'];
        copyTrip($tripId);
        return 1;
    }
    return 0;
}

echo makeACopyOfATrip();
