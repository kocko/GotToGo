<?php
session_start();

include_once 'head.php';

if (isset($_SESSION['user'])) {
    echo "Hello, " . $_SESSION['user']['fullname'];
} else {
    echo header('Location: /go');
}
