<?php

session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

function deleteTrip() {
    if ($_POST['tripId']) {
        $trip_id = $_POST['tripId'];
        $query = sprintf("DELETE FROM trip where id = '%s'", mysql_real_escape_string($trip_id));
        $result = mysql_query($query);
        return $result ? 1 : 0;
    }
    return 0;
}

echo deleteTrip();
