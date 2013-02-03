<?php
  include 'dbConnection.php';
  $pagination = '<div class="pagination pagination-centered"><ul>';

  //////// Getting pagination variables ////////
  if ($_GET['pageNum'] == null) {
    $pageNum = 1;
  }
  else {
    $pageNum = $_GET['pageNum'];
  }
  $prev = $pageNum-1;
  $next = $pageNum+1;

  if ($_GET['pageSize'] == null) {
    $pageSize = 10;
  }
  else {
    $pageSize = $_GET['pageSize'];
  }

  $result = mysql_query("SELECT count(*) as count FROM events WHERE startTime > '" . date('Y/m/d h:i:s', time()) . "'");
  $row = mysql_fetch_array($result);

  //////// Filling out the pagination string ////////
  if ($pageNum == 1) {
    $pagination .= '<li class="disabled"><a href="#"><<</a></li>';
  }
  else {
    $pagination .= '<li><a href="eventList.php?pageNum=' . $prev . '&pageSize=' . $pageSize . '"><<</a></li>';
  }

  $totalPages = intval(($row['count']-1)/$pageSize + 1);
  if ($totalPages < 10) {
    for ($i = 1; $i <= $totalPages; $i++) {
      if ($i == $pageNum) {
        $pagination .= '<li class="active"><a href="#">' . $i . '</a></li>';
      }
      else {
        $pagination .= '<li><a href="eventList.php?pageNum=' . $i . '&pageSize=' . $pageSize . '">' . $i . '</a></li>';
      }
    }
  }
  else if ($pageNum <= 9) {
    for ($i = 1; $i <= 9; $i++) {
      if ($i == $pageNum) {
        $pagination .= '<li class="active"><a href="#">' . $i . '</a></li>';
      }
      else {
        $pagination .= '<li><a href="eventList.php?pageNum=' . $i . '&pageSize=' . $pageSize . '">' . $i . '</a></li>';
      }
    }
    // insert ...
  }
  else if ($pageNum >= $totalPages-9) {
    // insert ...
    for ($i = $totalPages-9; $i <= $totalPages; $i++) {
      if ($i == $pageNum) {
        $pagination .= '<li class="active"><a href="#">' . $i . '</a></li>';
      }
      else {
        $pagination .= '<li><a href="eventList.php?pageNum=' . $i . '&pageSize=' . $pageSize . '">' . $i . '</a></li>';
      }
    }
  }
  else {
    // insert ...
    for ($i = $pageNum-4; $i <= $pageNum+4; $i++) {
      if ($i == $pageNum) {
        $pagination .= '<li class="active"><a href="#">' . $i . '</a></li>';
      }
      else {
        $pagination .= '<li><a href="eventList.php?pageNum=' . $i . '&pageSize=' . $pageSize . '">' . $i . '</a></li>';
      }
    }
    // insert ...
  }

  if ($pageNum == $totalPages) {
    $pagination .= '<li class="disabled"><a href="#">>></a></li>';
  }
  else {
    $pagination .= '<li><a href="eventList.php?pageNum=' . $next . '&pageSize=' . $pageSize . '">>></a></li>';
  }

  $pagination .= '</ul></div>';

  if ($totalPages == 1) {
    $pagination = '';
  }

  //////// Closing database connection ////////
  mysql_close($con);
?>
