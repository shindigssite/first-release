<?php
  include 'dbConnection.php';

  $details = "'S Wonderful 'S Wonderful is an all-singing, all-dancing celebration of the brilliant music and lyrics of brothers George and Ira Gershwin. Five mini-musicals take audiences on a ride to the different places times and styles that made the Gershwin brothers the most successful songwriting team in musical history. First it's New York City in 1916 and Paris in the '30s followed by Hollywood in the '40s, New Orleans in the '50s and today. 'S Wonderful pays a nostalgic tribute to the incomparable songbook of George and Ira Gershwin, featuring more than 40 classic hits such as \\\"Let’s Call the Whole Thing Off,\\\" \\\"Shall We Dance,\\\" \\\"Someone To Watch Over Me\\\" and \\\"Rhapsody in Blue.\\\"";
  $eventName = "\\'S Wonderful";
  $venue = "Jaeb Theater";
  $address = "1010 North W.C. MacInnes Place Tampa, FL 33602";
  $locale = 2;
  $price = "Regular: $32.50";
  $category = 9;

  for ($i = 82; $i <= 146; $i++) {
    $query = "INSERT INTO events (`id`, `details`, `eventName`, `venue`, `address`, `locale`, `price`, `category`) VALUES (" . $i . ", '" . str_replace("'", "\\'", $details) . "', '" . $eventName . "', '" . $venue . "', '" . $address . "', " . $locale . ", '" . $price . "', " . $category . ")";
    echo $query . '; ';
  }
  mysql_close($con);
?>
