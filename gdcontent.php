<!DOCTYPE html>
<html>
    <head>
<style>
.comments { width: 540px; height: 27px }
</style>
</head>

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
$userid=$_SESSION['userid'];

echo "Here are the groups you have: <br /><br />";
//if(isset($_POST['set'])){
 	$query = "SELECT gd_id FROM gdmembers WHERE gd_userid LIKE'$userid'";
 	$find_videos = $conn->query($query);
 	if($find_videos->num_rows>0){
	 	while ($row = $find_videos->fetch_assoc()) {
	 		$gd_id=$row['gd_id'];
	 		$result1 =$conn->query("SELECT gd_name FROM gdteams WHERE gd_id='$gd_id'");
	 		$row1 = $result1->fetch_assoc();
	 		$gd_name = $row1['gd_name'];	 		
	 		$sql="SELECT * FROM gdcontent WHERE gd_id='$gd_id' ORDER BY time";
	 		$results =$conn->query($sql);
	 		echo "Group Name:	 <b> $gd_name</b> <br /><br />	";
	 		if($results->num_rows>0){
	 			while($row2 = $results->fetch_assoc()){
	 				$user_id=$row2['user_id'];
	 				$result9 =$conn->query("SELECT username FROM User WHERE user_id='$user_id'");
	 				$row9 = $result9->fetch_assoc();
	 				$user_name = $row9['username'];
	 				$time = $row2['time'];
	 				$comment = $row2['comment'];
	 				echo "<b> $user_name:</b> &nbsp;&nbsp;&nbsp;Commented on: $time <br />";
	 				echo "Comment: $comment <br /><br />";
	 			}
	 		}
	 		echo" <br /> Would you like to post something?
	 		<form action='insert_discussion.php' method='post'>
	 		<input type='hidden' name = 'gd_id' value = '$gd_id'>
	 		<textarea class='comments'  name='gdcomment' id='comment' required></textarea><br />
	 		<input type='submit' value='Post' />
	 		</form><br />";
	 	}
 	} else {
 		echo "There are no groups for you to show";
 		echo "<a href='gd.php'> Go back</a>";
 	}
//}

// SELECT *
// FROM  `gdmembers`
// WHERE  `gdmembers`.`gd_id` =  '31'
// ORDER BY  `gdmembers`.`gd_userid` ASC

// 					<input type='hidden' name = 'mediaid' value = '$mediaid'>
// 					<input type='hidden' name = 'medianame' value = '$name'>
// 					<input type='hidden' name = 'mediatype' value = '$mediatype'>
