<?php

  include 'dbConnection.php';
  
  $categoriesResult = mysql_query("SELECT e.category AS id, c.categoryName AS catName, count(*) AS count FROM categories c, events e WHERE e.category = c.id GROUP BY e.category");
  $localeResult = mysql_query("SELECT e.locale AS id, l.localeName AS localeName, count(*) AS count FROM locales l, events e WHERE e.locale = l.id GROUP BY e.locale");
  // $groupResult = mysql_query();

  echo '<div class="span2">
  <div class="row"><strong>Categories</strong></div>';

  while ($row = mysql_fetch_array($categoriesResult)) {
    echo '<div class="row"><input type="checkbox" name="' . $row['catName'] . '" value="' . $row['id'] . '"> ' . $row['catName'] . '(' . $row['count'] . ')</div>';
  }

  echo '<br>
  <div class="row"><strong>Locale</strong></div>';

  while ($row = mysql_fetch_array($localeResult)) {
    echo '<div class="row"><input type="checkbox" name="' . $row['localeName'] . '" value="' . $row['id'] . '"> ' . $row['localeName'] . '(' . $row['count'] . ')</div>';
  }

  echo '<br>
  <div class="row"><strong>Dates</strong></div>
  <div class="row">From</div>
  <div class="row"><input type="textarea" name="fromDate"></div>
  <div class="row">To</div>
  <div class="row"><input type="textarea" name="toDate"></div>';

  echo '<br>
  <div class="row"><button class="btn">Update</button></div>';
  
  echo '</div>';

  mysql_close($con);
?>

