<?php

require_once '../database.php';

function fetchCitiesAndCountriesAsJson() {
    $result = mysql_query("SELECT city.name as cityName, country.name as countryName FROM city JOIN country ON city.countryCode=country.code");
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = array('city' => $r['cityName'], 'country' => $r['countryName']);
    }
    print json_encode($rows);
}

fetchCitiesAndCountriesAsJson();
