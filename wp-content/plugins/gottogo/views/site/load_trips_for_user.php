<?php

session_start();

include_once '../utils/trip_utils.php';

echo getTripsForCurrentUser($_SESSION['user']['id']);