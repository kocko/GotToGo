
<?php
include_once 'head.php';

session_start();
if (isset($_SESSION['user'])) {
    echo "Hello, " . $_SESSION['user']['fullname'];
} else {
    echo header('Location: /gottogo');
}