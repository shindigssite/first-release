<?php 
  include 'header.php';
?>

<!--<div class="row">
  <div class="span9 offset1" style="text-align:center"><img src="http://placehold.it/728x90"></img></div>
</div>-->
<div class="row">
  <div class="span2 offset7">
    <form class="form-inline">
      <label>Results Per Page: </label>
      <select name="numEvents" onChange="Refresh(this.value)">
        <option value="10"></option>
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="75">75</option>
      </select>
    </form>
  </div>
  <div class="span2">
    <form class="form-inline" action="addEvent.php">
      <button type="submit" class="btn">Add an Event</button>
    </form>
  </div>
</div>
<div class="row">
    <!-- Filters Div -->
<?php include 'filters.php'; ?>
    <!-- List Div -->
    <div class="span10">
<div class="row">

<?php
  include 'pagination.php';
  include 'dbConnection.php';

  if ($_SESSION['eventListQuery'] == '') {
    $query = "SELECT * FROM events WHERE startTime > '" . date('Y/m/d h:i:s', time()) . "' ORDER BY startTime ASC LIMIT " . ($pageNum-1)*$pageSize . ", " . $pageSize;
  }
  else {
    $query = "SELECT * FROM events e WHERE " . $_SESSION['eventListQuery'] . " ORDER BY startTime ASC LIMIT " . ($pageNum-1)*$pageSize . ", " . $pageSize;
  }

  $result = mysql_query($query);

  //////// Getting and printing the earliest startDate ////////
  $firstRecord = mysql_fetch_array($result);
  $currentDate = date_create($firstRecord['startTime']);
  mysql_data_seek($result, 0);

  echo "<div class=\"span6\"><h3>" . date_format($currentDate, 'l m/d') . "</h3></div>
	</div>";

  echo "<div class=\"row\">
        <div class=\"span9\">
        <table class=\"table table-hover\">";

  //////// Printing the events ////////
  while($row = mysql_fetch_array($result)) {
    $startTime = date_create($row['startTime']);
    if (date_format($startTime, 'y/m/d') > date_format($currentDate, 'y/m/d')) {
      $currentDate = $startTime;
      echo "</table></div></div>
	    <div class=\"row\">
 	    <div class=\"span9\"><h3>" . date_format($currentDate, 'l m/d') . "</h3></div>
	    </div><div class=\"row\">
            <div class=\"span9\">
            <table class=\"table table-hover\">";
    }

    echo "<tr id=\"" . $row['id'] . "\">
	  <td><a href=\"javascript:showEvent(" . $row['id'] . ")\"><i class=\"icon-plus\"></i></a> " . $row['eventName'];
    if ($row['venue'] != null) {
      echo " @ " . $row['venue'] . "</td>";
    }

    echo "<td style=\"text-align:right\">" . date_format($startTime, 'g:ia') . "</td>
          </tr>";
  }

  echo "</table>";
  echo $pagination;
  echo '</div></div>';
  include 'footer.php';

  echo "<script>
  function Refresh(numberOfEvents) {
    location.href=\"eventList.php?&pageSize=\" + numberOfEvents;
  }
  
  function showEvent(str) {
    if (str==\"\") {
      document.getElementById(str).innerHTML=\"\";
      return;
    } 
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
      xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById(str).innerHTML=xmlhttp.responseText;
      }
    }
  xmlhttp.open(\"GET\",\"eventDetails.php?eventId=\"+str,true);
  xmlhttp.send();
  }

  function hideEvent(eventId, name, venue, startTime) {
    var collapseString = \"<td><a href=\\\"javascript:showEvent(\" + eventId + \")\\\"><i class=\\\"icon-plus\\\"></i></a> \" + name;
    if (venue != '') {
      collapseString = collapseString + \" @ \" + venue + \"</td>\";
    }
    collapseString = collapseString + \"<td style=\\\"text-align:right\\\">\" + startTime + \"</td>\";
    document.getElementById(eventId).innerHTML=collapseString;
  }
  </script>";

  //////// Closing database connection ////////
  mysql_close($con);
?>
