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
if (isset($_POST['gdcomment'])){
	$comment = $_POST['gdcomment'];
	$userid = $_SESSION['userid'];
	$date = date("Y-m-d G-i-s");
	$gd_id = $_POST['gd_id'];
	$sql="INSERT INTO gdcontent(gd_id,user_id,comment,time) VALUES ('$gd_id','$userid','$comment','$date')";
	if (($conn->query($sql) == TRUE)){
		echo "Comment sucessful";
	}
	echo "<a href='gdcontent.php'> Go back </a>";
}