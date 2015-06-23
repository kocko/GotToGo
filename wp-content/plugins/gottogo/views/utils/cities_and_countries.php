<?php

require_once '../database.php';

function fetchCitiesAndCountriesAsJson() {
    $database = new Database();
    $connection = $database->getConnection();

    $query = "SELECT city.name as cityName, country.name as countryName FROM city JOIN country ON city.countryCode=country.code";
    $result = mysqli_query($connection, $query);

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = array('city' => $r['cityName'], 'country' => $r['countryName']);
    }
    print json_encode($rows);
}

fetchCitiesAndCountriesAsJson();
