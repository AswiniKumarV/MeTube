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

$From_UserID = $_SESSION["userid"];
$To_UserID = $_POST['to_userid'];
$Message = $_POST['msg'];
$time = date('Y-m-d G-i-s');
$msg_read = '1';

$sql="INSERT INTO Message(From_UserID,To_UserID,Message,time,msg_read) 
		VALUES ('$From_UserID', '$To_UserID', '$Message', '$time', '$msg_read')";
if ($conn->query($sql) === TRUE) {
		echo "<h5>Message sent successfully!</h5>";
}

echo "<a href='Messages.php'> Go back </a>";