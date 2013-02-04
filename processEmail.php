<?php
  include 'dbConnection.php';

  $id = time();

  $query = 'INSERT INTO email (id, message, name, address) VALUES (' . $id . ', \'' . str_replace("'", "\\'", $_POST['Message']) . '\', \'' . str_replace("'", "\\'", $_POST['Name']) . '\', \'' . str_replace("'", "\\'", $_POST['Email']) . '\')';

  mysql_query($query);
  mysql_close($con);
  header ("location:aboutUs.php");

  /*$emailTo = 'shindigssite@gmail.com';
  $subjectLine = 'Message From ' . $_POST['Name'];
  $messageBody = 'Name: ' . $_POST['Name'] 
		  . '\nEmail: ' . $_POST['Email']
		  . '\nMessage: ' . $_POST['Message'];
  
  mail($emailTo, $subjectLine, $messageBody);*/
?>
