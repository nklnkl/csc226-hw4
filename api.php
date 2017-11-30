<?php
  header('Content-type: application/json');
  $servername = "localhost";
  $username = "lagman";
  $password = "niko4850";
  $database = 'pageVisits';
  $conn = new mysqli($servername, $username, $password, $database, $port);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Localize vars.
  $page_name;
  $remote_host;
  $start_date;
  $end_date;

  // Check request vars.
  if ($_GET['page_name'])
    $page_name = "'" . mysql_real_escape_string($_GET['page_name']) . "'";
  if ($_GET['remote_host'])
    $remote_host = "'" . mysql_real_escape_string($_GET['remote_host']) . "'";
  if ($_GET['start_date'])
    $start_date = "'" . mysql_real_escape_string($_GET['start_date']) . "'";
  if ($_GET['end_date'])
    $end_date = "'" . mysql_real_escape_string($_GET['end_date']) . "'";

  // Starting query.
  $sql = "SELECT * FROM visitInfo";

  // page_name if set
  if ($page_name)
    $sql .= " WHERE page_name = " . $page_name;

  // remote host if set
  if ($remote_host) {
    // check for any previous WHERE clauses
    if ($page_name)
      $sql .= " AND remote_host = " . $remote_host;
    else
      $sql .= " WHERE remote_host = " . $remote_host;
  }

  // start date if set
  if ($start_date) {
    // check for any previous WHERE clauses
    if ($page_name || $remote_host)
      $sql .= " AND visit_date >= " . $start_date;
    else
      $sql .= " WHERE visit_date >= " . $start_date;
  }

  // start date if set
  if ($end_date) {
    // check for any previous WHERE clauses
    if ($page_name || $remote_host || $start_date)
      $sql .= " AND visit_date <= " . $end_date;
    else
      $sql .= " WHERE visit_date <= " . $end_date;
  }
  
  $result = $conn->query($sql);

  $rows;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  echo json_encode($rows);

?>
