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

$useid = $_SESSION["userid"];

$media_id = $_POST['mediaid'];
$friend_id = $_POST['frndid'];

$sql="INSERT INTO shared_media(user_id,media_id,shared_by_user_id) VALUES ('$friend_id', '$media_id', '$useid')";
if ($conn->query($sql) === TRUE) {
	echo "<h5>share successfully!</h5>";
	//echo "<br><A href = 'searchpro.php'> <h5>Return</h5></a></h5> ";
}
