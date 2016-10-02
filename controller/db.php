<?php

  $db_connection;


  function connect_to_db() {

    global $db_connection;

    $dbhost = 'localhost';
    $dbuser = 'admin';
    $dbpass = 'password';

    $db_connection = mysql_connect($dbhost, $dbuser, $dbpass);

    mysql_select_db("gradebook_data");

  }


  function disconnect_from_db() {
    global $db_connection;
    mysql_close($db_connection);
  }


?>
