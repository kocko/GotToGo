<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getBudgetCategories() {
    $query = "SELECT DISTINCT category from budget_planning order by category";
    $result = mysql_query($query, $GLOBALS['connection']);

    $ret = array();
    while($r = mysql_fetch_assoc($result)) {
        $ret[] = $r['category'];
    }

    return $ret;
}

function getBudgetCostsPerCategory($category) {
    $cat = mysql_real_escape_string($category);
    $query = sprintf("SELECT name, shared FROM budget_planning WHERE category='%s' order by id", $cat);
    $result = mysql_query($query, $GLOBALS['connection']);

    $ret = array();
    while ($r = mysql_fetch_assoc($result)) {
        $ret[] = array('name' => $r['name'], 'shared' => $r['shared']);
    }

    return $ret;
}
