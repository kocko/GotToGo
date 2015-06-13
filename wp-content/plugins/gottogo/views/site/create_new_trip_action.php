<?php
session_start();

require_once '../database.php';

require_once '../../../../../wp-load.php';

require_once '../utils/luggage_utils.php';

function createNewTrip() {
    if (isset($_POST['new_trip_action'])) {
        $user_id = $_SESSION['user']['id'];
        $destination = sanitize_text_field($_POST['destination']);
        $query = sprintf("INSERT INTO trip (user_id, destination) values ('%s','%s');",
            mysql_real_escape_string($user_id), mysql_real_escape_string($destination));

        $result = mysql_query($query, $GLOBALS['connection']);

        if (!$result) {
            return false;
        }

        $trip_id = mysql_insert_id();

        $categories = getLuggageItemsCategories();
        $items_query = "INSERT INTO trip_item(trip_id, name, category) VALUES ";

        $values_exist = false;
        foreach ($categories as $category) {
            $items = $_POST['selectedLuggageItems'][$category];

            if (!empty($items)) {
                $values_exist = true;
                foreach ($items as $item) {
                    $items_query .= "(" . $trip_id . ", '" . $item . "', '" . $category . "'),";
                }
            }
        }

        if ($values_exist) {
            $items_query = rtrim($items_query, ',');
            $result = mysql_query($items_query, $GLOBALS['connection']);

            if (!$result) {
                echo false;
            }
        }
    }
}

//function test() {
//    if (isset($_POST['new_trip_action'])) {
//
//
//            $items = $_POST['selectedLuggageItems'][$category];
//            echo "Category: " . $category . "<br />";
//
//                foreach ($items as $item) {
//                    echo $item;
//                }
//            }
//        }
//
//    }
//}

createNewTrip();
