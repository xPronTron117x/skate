<?php

  $servername = "localhost";
  $username = "RWROBLEWSKI";
  $password = "b7VeQ&hz";
  $DBName = "RWROBLEWSKI_DB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $DBName);

  // Check connection
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }

?>
