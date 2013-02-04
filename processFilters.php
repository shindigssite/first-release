<?php
  session_start();
  $categoryFlag = false;
  $localeFlag = false;
  $toDateFlag = false;
  $fromDateFlag = false;
  $firstWhereFlag = true;
  $eventListQuery = '';

  // Creating SQL strings
  if (sizeof($_POST['category']) > 0) {
    $categoryFlag = true;
    $firstItrFlag = true;
    $categoryStr = 'e.category IN(';
    
    foreach ($_POST['category'] as $value) {
      if (!$firstItrFlag) {
	$categoryStr = $categoryStr . ', ';
        $firstItrStr = false;
      }
      $categoryStr = $categoryStr . '\'' . $value . '\'';
    }
    
    $categoryStr = $categoryStr . ')';
  }

  if (sizeof($_POST['locale']) > 0) {
    $localeFlag = true;
    $firstItrFlag = true;
    $localeStr = 'e.locale IN(';

    foreach ($_POST['locale'] as $value) {
      if (!$firstItrFlag) {
	$localeStr = $localeStr . ', ';
        $firstItrStr = false;
      }
      $localeStr = $localeStr . '\'' . $value . '\'';
    }

    $localeStr = $localeStr . ')';
  }

  if ($_POST['toDate'] != '' && $_POST['toDate'] != 'mm/dd/yyyy') {
    $toDateFlag = true;
    list($month, $day, $year) = explode("/", $_POST['toDate']);
    $toDateStr = 'e.startTime <= \'' . date('Y/m/d h:i:s', mktime(23, 59, 59, $month, $day, $year)) . '\'';
  }

  if ($_POST['fromDate'] != '' && $_POST['fromDate'] != 'mm/dd/yyyy') {
    $fromDateFlag = true;
    list($month, $day, $year) = explode("/", $_POST['fromDate']);
    $fromDateStr = 'e.startTime >= \'' . date('Y/m/d h:i:s', mktime(0, 0, 0, $month, $day, $year)) . '\'';
  }

  // Combining SQL strings
  if ($categoryFlag || $localeFlag || $toDateFlag || $fromDateFlag) {
    if ($categoryFlag) {
      if ($firstWhereFlag) {
	$eventListQuery = $eventListQuery . $categoryStr;
        $firstWhereFlag = false;
      }
      else {
	$eventListQuery = $eventListQuery . ' AND ' . $categoryStr;
      }
    }

    if ($localeFlag) {
      if ($firstWhereFlag) {
	$eventListQuery = $eventListQuery . $localeStr;
        $firstWhereFlag = false;
      }
      else {
	$eventListQuery = $eventListQuery . ' AND ' . $localeStr;
      }
    }

    if ($toDateFlag) {
      if ($firstWhereFlag) {
	$eventListQuery = $eventListQuery . $toDateStr;
        $firstWhereFlag = false;
      }
      else {
	$eventListQuery = $eventListQuery . ' AND ' . $toDateStr;
      }
    }

    if ($fromDateFlag) {
      if ($firstWhereFlag) {
	$eventListQuery = $eventListQuery . $fromDateStr;
        $firstWhereFlag = false;
      }
      else {
	$eventListQuery = $eventListQuery . ' AND ' . $fromDateStr;
      }
    }
    $_SESSION['eventListQuery'] = $eventListQuery;
  }
  else {
    $_SESSION['eventListQuery'] = '';
  }

  header ("location:eventList.php");
  
?>
