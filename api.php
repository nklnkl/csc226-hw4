<?php
  $servername = "localhost";
  $username = "lagman";
  $password = "niko4850";
  $database = 'pageVisits';
  $port = 3306;
  $conn = new mysqli($servername, $username, $password, $database, $port);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
?>
