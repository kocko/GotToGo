<?php
session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

require_once '../utils/luggage_utils.php';

function createNewTrip() {
    $database = new Database();
    $connection = $database->getConnection();

    $user_id = $_SESSION['user']['id'];
    $destination = sanitize_text_field($_POST['destination']);
    $tourists_count = "1";
    if ($_POST['touristsCount']) {
        $tourists_count = sanitize_text_field($_POST['touristsCount']);
    }
    $nights_count = "1";
    if ($_POST['nightsCount']) {
        $nights_count = sanitize_text_field($_POST['nightsCount']);
    }
    $query = sprintf("INSERT INTO trip (user_id, destination, tourists, nights) values ('%s','%s', '%s', '%s');", $user_id, $destination,  $tourists_count, $nights_count);

    mysqli_query($connection, $query);

    $trip_id = mysqli_insert_id($connection);
    $items_query = "INSERT INTO trip_item(trip_id, name, category) VALUES ";

    if ($_POST['selectedLuggageItems']) {
        $postedItems = $_POST['selectedLuggageItems'];
        foreach ($postedItems as $entry) {
            $category = $entry[0];
            $item = $entry[1];
            $items_query .= "(" . $trip_id . ", '" . $item . "', '" . $category . "'),";
        }

        $items_query = rtrim($items_query, ',');
        $result = mysqli_query($database->getConnection(), $items_query);

        if (!$result) {
            return false;
        }
    }

    $budget_query = "INSERT into trip_budget(trip_id, name, category, cost, shared) VALUES ";
    if ($_POST['budgetItems']) {
        $postedBudgetItems = $_POST['budgetItems'];
        foreach ($postedBudgetItems as $entry) {
            $name = $entry[0];
            $cost = $entry[1];
            $category = $entry[2];
            $shared = $entry[3];
            $budget_query .= "(" . $trip_id . ", '" . $name . "', '" . $category . "', '" . $cost . "', '" . $shared . "'),";
        }

        $budget_query = rtrim($budget_query , ',');
        $result = mysqli_query($database->getConnection(), $budget_query);

        if (!$result) {
            return false;
        }
    }
    return true;
}

echo createNewTrip();
