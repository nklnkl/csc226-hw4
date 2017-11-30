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

  $sql = "SELECT * FROM visitInfo";
  $result = $conn->query($sql);
  $rows;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  echo json_encode($rows);

?>
