<?php

  $host = "localhost"; 
  $username = "novtgu8m"; 
  $password = "Hoffmann123@";
  $db_name = "novtgu8m_trips"; // Database name 

  // Connect to server and select database.
  $link = mysql_connect("$host", "$username", "$password") or die("cannot connect"); 

  if (!$link) {
      die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("$db_name")or die("cannot select DB");

?>