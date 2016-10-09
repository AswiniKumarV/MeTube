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

	$query = "SELECT * FROM media ORDER BY view_time LIMIT 5";
	$find_videos = $conn->query($query);	
	if($find_videos->num_rows>0){
		while ($row = $find_videos->fetch_assoc()) {
			$name = $row['title'];
			$mediaid = $row['media_id'];
			$mediatype = $row['type'];
			$searchterms = $row['keywords'];
			
			//$name .= ".mp4";
			echo "<video width='200'>\n";
			echo "<source src='$name.$mediatype' type='video/mp4'>";
			echo "<source src='mov_bbb.ogg' type='video/ogg'>";
			echo "Your browser does not support HTML5 video.";
			echo "</video><br />";
			
			/**************** modified ********/
			echo "<form action='watch.php' method='get'>";
			
			//echo "<form action='watch.php' method='get'>";
			
			echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
			echo "<input type='hidden' name = 'medianame' value = '$name'>";
			echo "<input type='hidden' name = 'mediatype' value = '$mediatype'>";
			echo "<input type='hidden' name = 'searchterms' value = '$searchterms'>";
			$mediatitle = $row['title'];
			echo "To Watch Click:<input type='submit' value = '$mediatitle' name='xyz'>";
			echo "</form>";
			
			echo "<form action='share_media.php' method='get'>";
			echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
			echo "<input type='submit' value='Share Me!!' name='meid'>";
			echo "</form>";
			echo "<br /><br /><br />";
		}
	} else{
		echo "There are now results to display for your search";
		Echo "<h2><A href = 'featurebasedsearch.php'>Go back</h5></a></h2>";
	}
?>