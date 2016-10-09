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

if(isset($_POST['groupname'])){
	$name = $_POST['groupname'];
	$ownerid = $_SESSION['userid'];
	// $mediatype = $_GET['mediatype'];
	// $searchterms = $_GET['searchterms'];
	
	$sql="SELECT gd_name FROM gdteams WHERE gd_name='$name'";
	$results = $conn->query($sql);
	if($results->num_rows>0){
		echo "This name already exists, Please enter another name:";
		echo "<a href='gd.php'> Go back</a>";
	}
	else{
		$sql1="INSERT INTO gdteams(gd_id,owner_id,gd_name) VALUES(' ','$ownerid','$name')";
	    if($conn->query($sql1) === TRUE){
			echo "Group created sucessfully<br />";
			
			$sql3="SELECT * FROM gdteams WHERE gd_name='$name'";
			$results3 = $conn->query($sql3);		
			//echo "$results3->num_rows";
			if($results3->num_rows>0){
				$row = $results3->fetch_assoc();
				$gd_id = $row['gd_id'];
				//echo $gd_id.$ownerid."<br />";
				$sql2="INSERT INTO gdmembers(gd_id,gd_userid) VALUES('$gd_id','$ownerid')";
				if($conn->query($sql2)){
					//echo "sucess";
				} else{
					echo "failed";
				}
			}
			else{
				echo "failed";
			}
// 			$sql2="INSERT INTO gdmembers(gd_id,gd_userid,) VALUES('$gd_id','$ownerid')";
// 			$conn->query($sql2);
			
			echo "<a href='gd.php'> Go back</a>";
		}else {
			echo "Create failed!!";
			echo "<a href='gd.php'> Go back</a>";
		}
	}
}
//action="addgd.php"
?>







