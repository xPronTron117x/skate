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
$cop = $_POST["cop"];
$rating = $_POST["rating"];
$type = $_POST["type"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$lat = floatval($lat);
$lng = floatval($lng);
$pic = $_POST["pic"];

$query = "INSERT INTO skatespot (name, cop, rating, type, lng, lat, pic)
VALUES ('$name', '$cop', '$rating', '$type', '$lng', '$lat', '$pic')";

if ($conn->query($query) === TRUE) {
    echo "Saved!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
