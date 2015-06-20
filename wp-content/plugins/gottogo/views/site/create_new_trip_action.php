<?php
session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

require_once '../utils/luggage_utils.php';

function createNewTrip() {
    $user_id = $_SESSION['user']['id'];
    $destination = sanitize_text_field($_POST['destination']);
    $tourists_count = sanitize_text_field($_POST['tourists_count']);
    $nights_count = sanitize_text_field($_POST['nights_count']);
    $query = sprintf("INSERT INTO trip (user_id, destination, tourists, nights) values ('%s','%s', '%s', '%s');",
        mysql_real_escape_string($user_id), mysql_real_escape_string($destination),
        mysql_real_escape_string($tourists_count), mysql_real_escape_string($nights_count));

    $result = mysql_query($query, $GLOBALS['connection']);

    if (!$result) {
        return false;
    }

    $trip_id = mysql_insert_id();
    $items_query = "INSERT INTO trip_item(trip_id, name, category) VALUES ";

    if ($_POST['selectedLuggageItems']) {
        $postedItems = $_POST['selectedLuggageItems'];
        foreach ($postedItems as $entry) {
            $category = $entry[0];
            $item = $entry[1];
            $items_query .= "(" . $trip_id . ", '" . $item . "', '" . $category . "'),";
        }

        $items_query = rtrim($items_query, ',');
        $result = mysql_query($items_query, $GLOBALS['connection']);

        if (!$result) {
            echo false;
        }
    }
    return true;
}

echo createNewTrip();
