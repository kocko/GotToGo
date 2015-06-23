<?php
session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

require_once '../utils/luggage_utils.php';

function updateTrip() {
    $database = new Database();
    $connection = $database->getConnection();

    $trip_id = $_POST['tripId'];
    $tourists_count = "1";
    if ($_POST['touristsCount']) {
        $tourists_count = sanitize_text_field($_POST['touristsCount']);
    }
    $nights_count = "1";
    if ($_POST['nightsCount']) {
        $nights_count = sanitize_text_field($_POST['nightsCount']);
    }
    $query = sprintf("UPDATE trip SET tourists = " . $tourists_count . ", nights = " . $nights_count . " WHERE id = " . $trip_id);
    $result = mysqli_query($connection, $query);

    if (!$result) {
        return false;
    }

    if ($_POST['selectedLuggageItems']) {
        $deleteQuery = "DELETE FROM trip_item where trip_id = " . $trip_id;
        $result = mysqli_query($connection, $deleteQuery);

        if (!$result) {
            return false;
        }

        $postedItems = $_POST['selectedLuggageItems'];
        $items_query = "INSERT INTO trip_item(trip_id, name, category) VALUES ";
        foreach ($postedItems as $entry) {
            $category = $entry[0];
            $item = $entry[1];
            $items_query .= "(" . $trip_id . ", '" . $item . "', '" . $category . "'),";
        }

        $items_query = rtrim($items_query, ',');
        $result = mysqli_query($connection, $items_query);

        if (!$result) {
            return false;
        }
    }

//    $budget_query = "INSERT into trip_budget(trip_id, name, category, cost, shared) VALUES ";
//    if ($_POST['budgetItems']) {
//        $postedBudgetItems = $_POST['budgetItems'];
//        foreach ($postedBudgetItems as $entry) {
//            $name = $entry[0];
//            $cost = $entry[1];
//            $category = $entry[2];
//            $shared = $entry[3];
//            $budget_query .= "(" . $trip_id . ", '" . $name . "', '" . $category . "', '" . $cost . "', '" . $shared . "'),";
//        }
//
//        $budget_query = rtrim($budget_query , ',');
//        $result = mysql_query($budget_query , $GLOBALS['connection']);
//
//        if (!$result) {
//            return false;
//        }
//    }
    return true;
}

echo updateTrip();