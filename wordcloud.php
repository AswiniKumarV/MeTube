<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>
<head>
</head>
<body>
<form action="searchpro.php" method="post">
	<?php 
	
	echo "<br /><br /><br />Would do like to search using the word cloud below for ease... <br /><br /><br />";
	$i=0;
	$query = "SELECT title, keywords FROM media";
	$find_media = $conn->query($query);
	if($find_media->num_rows>0){
		echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		while ($row = $find_media->fetch_assoc()) {
			$title = $row['title'];
			$keywords = $row['keywords'];
			$n = $i%6;
			switch($n) {
				case 0: 
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#0000FF'>$title</font></a> &nbsp";
					break 1;
				case 1:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#00FF00'>$title </font></a> &nbsp";
					break 1;
				case 2:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF0000'>$title</font></a> &nbsp";
					break 1;
				case 3:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF0000'>$title</font></a> &nbsp";
					break 1;
				case 4:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#0000FF'>$title</font></a> &nbsp";
					break 1;
				case 5:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF9900'>$title</font></a> &nbsp";
					break 1;
			}
			switch($n) {
				case 0:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF00FF'>$keywords</font></a> &nbsp";
					break 1;
				case 1:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#ff0000'>$keywords</font></a>
					<br />&nbsp &nbsp &nbsp"; echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
					break 1;
				case 2:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#0000ff'>$keywords</font></a> &nbsp";
					break 1;
				case 3:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF00ff'>$keywords</font></a> &nbsp";
					echo"<br /> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
					break 1; 
				case 4:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF9900'>$keywords</font></a> &nbsp";
					break 1;
				case 5:
					echo "<a href='searchpro.php?searchterms=$title' name='searchterms'><font color='#FF0066'>$keywords</font></a><br />";
					echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
					break 1;
			}
			$i++;
		}
	}		
	?>
</form>
</body>
</html>
