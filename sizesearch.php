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
?>
<html>
    <head>
        <style>
            h3{
                font-family:verdana;
                color:indigo;
            }

            #vedio
            {
                font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
                width:100%;
                border-collapse:collapse;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <table id="vedio">
            <tr>
				<?php
if(isset($_POST['sizesearch'])){
	$size = $_POST['sizesearch'];
	$lowersize = $size-5000000;
	$query = "SELECT * FROM media WHERE size<='$size' and size>'$lowersize'";
	$result = $conn->query($query);
    $num = $result->num_rows;
     include "display.php";
	/*if($find_videos->num_rows>0){
		while ($row = $find_videos->fetch_assoc()) {
			$name = $row['title'];
			$mediaid = $row['media_id'];
			$mediatype = $row['type'];
			$searchterms = $row['keywords'];
	
			//$name .= ".mp4";
			echo "<video width='100'>\n";
			echo "<source src='$name.$mediatype' type='video/mp4'>";
			echo "<source src='mov_bbb.ogg' type='video/ogg'>";
			echo "Your browser does not support HTML5 video.";
			echo "</video><br />";
			
			/**************** modified ********/
			/*echo "<form action='video.php' method='get'>";
			
			//echo "<form action='watch.php' method='get'>";
			
			echo "<input type='hidden' name = 'id' value = '$mediaid'>";
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
		}*/
		
	if($result->num_rows==0){
			
		//echo "<h3>There are now results to display for your search</h3>";
		
	}
	}

echo "<h2><A href = 'search.php'>Go back</a></h2>";
?>
</tr>
        </table>
    </body>
</html>

