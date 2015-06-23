<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getLuggageItemsCategories() {
    $database = new Database();
    $connection = $database->getConnection();

    $query = "SELECT DISTINCT category from luggage_item order by category";
    $result = mysqli_query($connection, $query);

    $ret = array();
    while($r = mysqli_fetch_assoc($result)) {
        $ret[] = $r['category'];
    }

    return $ret;
}

function getLuggageItemsPerCategory($category) {
    $database = new Database();
    $connection = $database->getConnection();

    $cat = mysqli_real_escape_string($connection, $category);
    $query = sprintf("SELECT DISTINCT name FROM luggage_item WHERE category='%s' order by id", $cat);
    $result = mysqli_query($connection, $query);

    $ret = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $ret[] = $r['name'];
    }

    return $ret;
}
