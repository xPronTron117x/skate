<?php
  require("opendb.php");
  global $conn;


$servername = "localhost";
$username = "RWROBLEWSKI";
$password = "b7VeQ&hz";
$DBName = "RWROBLEWSKI_DB";
// Create connection
$conn = new mysqli($servername, $username, $password, $DBName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST["name"];
$type = $_POST["type"];
$rating = $_POST["rating"];
$lat = $_POST["lat"];
$long = $_POST["long"];
$lat = floatval($lat);
$long = floatval($long);

$query = "INSERT INTO skatespot (name, rating, type, lng, lat)
VALUES ('$name', '$rating', '$type', '$long', '$lat')";

if ($conn->query($query) === TRUE) {
    echo "Saved!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
