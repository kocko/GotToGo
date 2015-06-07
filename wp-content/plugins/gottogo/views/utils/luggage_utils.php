<?php

require_once '../database.php';

require_once '../../../../../wp-load.php';

function getLuggageItemsCategories() {
    $query = "SELECT DISTINCT category from luggage_item order by category";
    $result = mysql_query($query, $GLOBALS['connection']);

    $ret = array();
    while($r = mysql_fetch_assoc($result)) {
        $ret[] = $r['category'];
    }

    return $ret;
}

function getLuggageItemsPerCategory($category) {
    $cat = mysql_real_escape_string($category);
    $query = sprintf("SELECT DISTINCT name FROM luggage_item WHERE category='%s' order by id", $cat);
    $result = mysql_query($query, $GLOBALS['connection']);

    $ret = array();
    while ($r = mysql_fetch_assoc($result)) {
        $ret[] = $r['name'];
    }

    return $ret;
}