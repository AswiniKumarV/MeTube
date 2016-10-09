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

if(isset($_POST['gdid'])){
	$gd_id = $_POST['gdid'];
	$gd_userid = $_SESSION['userid'];
	
	$sql2="INSERT INTO gdmembers(gd_id,gd_userid) VALUES('$gd_id','$gd_userid')";
	if($conn->query($sql2)){
		echo "sucess";
	}
	
	echo "<a href='gd.php'> Go back </a>";
	
}