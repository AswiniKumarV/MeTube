<?php 

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

//$name = $_GET['medianame'];
//$mediaid = $_GET['mediaid'];
//$mediatype = $_GET['mediatype'];
$mediatype=$type;
//$searchterms = $_GET['searchterms'];
$searchterms=$keywords;
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
<style>
header {
    width:100%;
    background-color:indigo;
    color:white;
    text-align:center;
    padding:5px;
}


nav {
    line-height:80px;
    width:140px;
    background-color:#DF5500;
    float:left;
    padding:5px;
    text-align: center;
}

aside {
    text-align:center;
    background-color:#FF9900;
/*     height:900px; */
    width:250px;
    float:right;
    padding:5px;	      
}
section {
    width:350px;
    float:right;
    padding:10px;	 	 
}
footer {
    background-color:indigo;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;	 	 
}
a{
    color:white;
    text-decoration:none;
    text-transform: capitalize;
}

.comments { width: 450px; height: 75px }
</style>
</head>
 <aside>
 Recommended Media for You<br /><br />
 <?php 
  //$search = mysql_real_escape_string('$searchterms');
 $query2 = "SELECT * FROM media WHERE (keywords LIKE'%$searchterms%' or title LIKE'%$searchterms%')
 			and category<>'image' and media_id<>'$mediaid'";
 $find_videos = $conn->query($query2);
 if($find_videos->num_rows>0){
 	while ($row = $find_videos->fetch_assoc()) {
 		$name = $row['title'];
 		$mediaid = $row['media_id'];
 		$mediatype = $row['type'];
 		//$name .= ".mp4";
 		echo "<video width='200' >\n";
 		echo "<source src='$name.$mediatype' type='video/mp4'>";
 		echo "<source src='mov_bbb.ogg' type='video/ogg'>";
 		echo "Your browser does not support HTML5 video.";
 		echo "</video><br />";
 			
 			
 		echo "<form action='video.php' method='get'>";
 		echo "<input type='hidden' name = 'id' value = '$mediaid'>";
 		echo "<input type='hidden' name = 'medianame' value = '$name'>";
 		echo "<input type='hidden' name = 'mediatype' value = '$mediatype'>";
 		echo "<input type='hidden' name = 'searchterms' value = '$searchterms'>";
 		$mediatitle = $row['title'];
 		echo "To Watch Click:<input type='submit' value = '$mediatitle' name='xyz'>";
 		echo "</form><br />";
 	}
 }
 $query3 = "SELECT * FROM media WHERE category<>'image' and media_id<>'$mediaid'";
 $find_videos = $conn->query($query3);
 if($find_videos->num_rows>0){
 	while ($row = $find_videos->fetch_assoc()) {
 		$name = $row['title'];
 		$mediaid = $row['media_id'];
 		$mediatype = $row['type'];
 		//$name .= ".mp4";
 		echo "<video width='200'>\n";
 		echo "<source src='$name.$mediatype' type='video/mp4'>";
 		echo "<source src='mov_bbb.ogg' type='video/ogg'>";
 		echo "Your browser does not support HTML5 video.";
 		echo "</video><br />";
 
 
 		echo "<form action='video.php' method='get'>";
 		echo "<input type='hidden' name = 'id' value = '$mediaid'>";
 		echo "<input type='hidden' name = 'medianame' value = '$name'>";
 		echo "<input type='hidden' name = 'mediatype' value = '$mediatype'>";
 		echo "<input type='hidden' name = 'searchterms' value = '$searchterms'>";
 		$mediatitle = $row['title'];
 		echo "To Watch Click:<input type='submit' value = '$mediatitle' name='xyz'>";
 		echo "</form><br />";
 	}
 }
 ?>
 </aside>
</html>


<?php
// $name = $_GET['medianame'];
// echo "<video width='400' controls>\n";
// echo "<source src='$name.$mediatype' type='video/mp4'>";
// echo "<source src='mov_bbb.ogg' type='video/ogg'>";
// echo "Your browser does not support HTML5 video.";
// echo "</video><br />";

// echo "<table>";
// echo "<tr>";
// echo "<td>";
// echo "<form action='share_media.php' method='get'>";
// echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
// echo "<input type='submit' value='Share Me!!' name='meid'>";
// echo "</form>";
// echo "</td>";

// echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
// 		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>";

// echo "<td>";
// echo "<form action='rate_media.php' method='get'>";
// echo "<input type='submit' value='submit rating' name='submit'>";
// echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
// echo "<select name='mediarating' required>";
// echo "<option value=''></option>";
// echo "<option value='1'>1</option>";
// echo "<option value='2'>2</option>";
// echo "<option value='3'>3</option>";
// echo "<option value='4'>4</option>";
// echo "<option value='5'>5</option>";
// echo "<option value='6'>6</option>";
// echo "<option value='7'>7</option>";
// echo "<option value='8'>8</option>";
// echo "<option value='9'>9</option>";
// echo "<option value='10'>10</option>";
// echo "</select> **";
// echo "</form>";
// echo "</td>";
// echo "</tr>";
// echo "</table>";


?>
<!-- </html> -->
<!--  <input type='hidden' name='articleid' id='articleid' value='<? echo $_GET["id"]; ?>' /> -->
