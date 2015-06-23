<?php

session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

function deleteTrip() {
    if ($_POST['tripId']) {
        $database = new Database();
        $trip_id = $_POST['tripId'];
        $query = sprintf("DELETE FROM trip where id = '%s'", $trip_id);
        $result = mysqli_query($database->getConnection(), $query);
        return $result ? 1 : 0;
    }
    return 0;
}

echo deleteTrip();
