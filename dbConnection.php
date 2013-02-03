<?php

  //////// Database connection ////////
  $con = mysql_connect("aau7m7qdtfet2a.cc0o3cshvgy3.us-east-1.rds.amazonaws.com", "root", "a1141420");
  if (!$con) {
    die('Could not connect: ' . mysql_error());
  }

  mysql_select_db("shin-digs", $con);

?>
