<?php

  require_once 'database.php';

  $login_email = $_POST['login_email']; 
  $login_password = $_POST['login_password']; 
    
  $row = mysql_fetch_assoc(mysql_query("SELECT fullname FROM users WHERE email = '" . $login_email . "' AND password = '" . $login_password . "'"));

  if ($row['fullname']) {
    echo "Hello, " + $row['fullname'];
  } else {
    echo "Given username: ". $login_email . "<br/>";
    echo "Given password: ". $login_password . "<br/>";
    echo "Wrong Username or Password";
  }
   
?>