<?php
  $emailTo = 'shindigssite@gmail.com';
  $subjectLine = 'Message From ' . $_POST['Name'];
  $messageBody = 'Name: ' . $_POST['Name'] 
		  . '\nEmail: ' . $_POST['Email']
		  . '\nMessage: ' . $_POST['Message'];
  
  mail($emailTo, $subjectLine, $messageBody);

  header ("location:aboutUs.php");
?>
