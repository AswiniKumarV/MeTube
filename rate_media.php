<?php
session_start();
$servername = "mysql1.cs.clemson.edu";
$username = "Metube_2b0d";
$password = "metube15";
$dbname = "Metube_yu37";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$mediaid = $_GET['mediaid'];
$rating = $_GET['mediarating'];

$query = "SELECT rate_time, rate FROM media WHERE media_id LIKE'$mediaid'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$ratetime = $row['rate_time'];
$avg_rate = $row['rate'];

$avg_rate = ($avg_rate*$ratetime + $rating)/ ($ratetime+1);
$ratetime = $ratetime +1;
//echo "$viewtime $avg_rate";

$query1 = "UPDATE media SET  rate_time = '$ratetime', rate =  '$avg_rate' WHERE  media_id LIKE'$mediaid'";
if($conn->query($query1)){
	echo "rating successful!!";
}


