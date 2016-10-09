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


$medianame = $_POST['medianame'];
$mediaid = $_POST['mediaid'];
$mediatype = $_POST['mediatype'];



	if (isset($_POST)){
		$comment = $_POST['comment'];
		$userid = $_SESSION['userid'];
		$date = date("Y-m-d G-i-s");

		$sql="INSERT INTO Comments(media_id,user_id,comment,time) VALUES ('$mediaid','$userid','$comment','$date')";
		if (($conn->query($sql) == TRUE)){
			echo "Comment sucessful";
		}
	}
