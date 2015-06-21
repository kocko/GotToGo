<?php

function getTripsForCurrentUser($userId) {
    $result = mysql_query("SELECT id as tripId, destination as destination, tourists as tourists, nights as nights FROM trip WHERE user_id = ". $userId);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('destination' => $r['destination'], 'id' => $r['tripId'],
                        'tourists' => $r['tourists'], 'nights' => $r['nights']);
    }
    return $rows;
}

function copyTrip($trip_id) {
    $newTripId = makeTripCopy($trip_id);
    makeTripItemsCopy($trip_id, $newTripId);
    makeBudgetItemsCopy($trip_id, $newTripId);
}

function makeTripCopy($trip_id) {
    $query = sprintf("SELECT user_id as user_id, destination as destination FROM trip WHERE id = '%d'", $trip_id);
    $result = mysql_query($query, $GLOBALS['connection']);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('destination' => $r['destination'], 'user_id' => $r['user_id']);
    }
    $destination = $rows[0]['destination'];
    $user_id = $rows[0]['user_id'];
    $newTripQuery = sprintf("INSERT INTO trip(user_id, destination) values (%s, '%s')",
                                mysql_real_escape_string($user_id),
                                mysql_real_escape_string($destination));
    mysql_query($newTripQuery, $GLOBALS['connection']);
    return mysql_insert_id();
}

function makeTripItemsCopy($old_trip_id, $new_trip_id) {
    $items_query = sprintf("SELECT name as name, category as category FROM trip_item where trip_id = " . $old_trip_id);
    $result = mysql_query($items_query, $GLOBALS['connection']);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('name' => $r['name'], 'category' => $r['category']);
    }
    if ($rows) {
        $insert_query = "INSERT INTO trip_item (trip_id, name, category) values ";
        foreach ($rows as $item) {
            $insert_query .= "(" . $new_trip_id . ", '" . $item['name'] . "', '" . $item['category'] . "'),";
        }
        $insert_query = rtrim($insert_query, ',');
        $result = mysql_query($insert_query, $GLOBALS['connection']);
        if (!$result) {
            die ("error in database connection");
        }
    }
}

function makeBudgetItemsCopy($old_trip_id, $new_trip_id) {
    $items_query = sprintf("SELECT name as name, category as category, cost as cost, shared as shared FROM trip_budget where trip_id = " . $old_trip_id);
    $result = mysql_query($items_query, $GLOBALS['connection']);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('name' => $r['name'],
                        'category' => $r['category'],
                        'cost' => $r['cost'],
                        'shared' => $r['shared']);
    }
    if ($rows) {
        $insert_query = "INSERT INTO trip_budget (trip_id, name, category, cost, shared) values ";
        foreach ($rows as $item) {
            $insert_query .= "(" . $new_trip_id . ", '" . $item['name'] . "', '" . $item['category'] . "', '" . $item['cost'] . "', '" . $item['shared'] . "'),";
        }
        $insert_query = rtrim($insert_query, ',');
        $result = mysql_query($insert_query, $GLOBALS['connection']);
        if (!$result) {
            die ("error in database connection");
        }
    }
}

function getTripsForCurrentUserWithId($user_id, $trip_id) {
    $trips = getTripsForCurrentUser($user_id);
    if (count($trips) > 0) {
        foreach ($trips as $trip) {
            if ($trip['id'] == $trip_id) {
                return $trip;
            }
        }
    }
    return -1;
}

function getTripItemsForTripWithId($trip_id) {
    $items_query = sprintf("select category, group_concat(DISTINCT name SEPARATOR ',') AS items from trip_item where trip_id = " . $trip_id . " group by category");
    $result = mysql_query($items_query, $GLOBALS['connection']);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('items' => $r['items'], 'category' => $r['category']);
    }
    return $rows;
}

function getTripBudgetForTripWithId($trip_id) {
    $budget_query = sprintf("SELECT name as name, category as category, cost as cost, shared as shared FROM trip_budget where trip_id = " . $trip_id);
    $result = mysql_query($budget_query, $GLOBALS['connection']);
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('name' => $r['name'],
                        'category' => $r['category'],
                        'cost' => $r['cost'],
                        'shared' => $r['shared']);;
    }
    return $rows;
}
