<?php
class Database {
    function getConnection() {
        $host = "localhost";
        $username = "novtgu8m";
        $password = "Hoffmann123@";
        $db_name = "novtgu8m_trips";

        $connection = mysqli_connect("$host", "$username", "$password", "$db_name") or die("cannot connect");

        if (mysqli_connect_errno()) {
            die('Could not connect: ' . mysqli_error($connection));
        }
        return $connection;
    }
}