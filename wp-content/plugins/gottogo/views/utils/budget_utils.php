<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getBudgetCategories() {
    $database = new Database();
    $query = "SELECT DISTINCT category from budget_planning order by category";
    $result = mysqli_query($database->getConnection(), $query);

    $ret = array();
    while($r = mysqli_fetch_assoc($result)) {
        $ret[] = $r['category'];
    }

    return $ret;
}

function getBudgetCostsPerCategory($category) {
    $database = new Database();
    $connection = $database->getConnection();

    $cat = mysqli_real_escape_string($connection, $category);
    $query = sprintf("SELECT name, shared FROM budget_planning WHERE category='%s' order by id", $cat);
    $result = mysqli_query($connection, $query);

    $ret = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $ret[] = array('name' => $r['name'], 'shared' => $r['shared']);
    }

    return $ret;
}
