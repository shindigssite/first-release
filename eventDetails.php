<?php
 $eventId = $_GET["eventId"];
 include 'dbConnection.php';

  $result = mysql_query("SELECT * FROM events e, categories c, locales l WHERE e.id = " . $eventId . " and e.category = c.id and e.locale = l.id");
  $record = mysql_fetch_array($result);
  
  echo "<td><a href=\"javascript:hideEvent(" . $eventId . ", '" . str_replace("'", "\\'", $record['eventName']) . "', '" . $record['venue'] . "', '" . date_format(date_create($record['startTime']), 'g:ia') . "')\"><i class=\"icon-minus\"></i></a> <table class=\"table-event-details\">";
  echo"<tr><thead><strong>" . $record['eventName'] . "</strong></thead></tr>";
  echo "<tr><td>" . $record['venue'] . " " . date_format(date_create($record['startTime']), 'm/d g:ia') . "</td></tr>";
  echo "<tr><td>" . $record['address'] . "</td></tr>";
  echo "<tr><td><strong>Event Description:</strong></td></tr>";
  echo "<tr><td>" . $record['details'] . "</td></tr>";
  echo "<tr><td><strong>Price:</strong></td></tr>";
  echo "<tr><td>" . $record['price'] . "</td></tr>";
  echo "<tr><td><strong>Locale:</strong> " . $record['localeName'] . "</td></tr>"; 
  echo "<tr><td><strong>Category:</strong> " . $record['categoryName'] . "</td></tr>";
  echo "</table></td>";

  mysql_close($con);
?>
