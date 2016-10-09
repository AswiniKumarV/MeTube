<?php
session_start();
include 'connect_database.php';

$mediaid=$_POST["mediaid"];
$sql = "SELECT * FROM media WHERE media_id=$mediaid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$path=$row["path"];
$title=$row["title"];
$size=$row['size'];
$type=$row['type'];
$category=$row['category'];

    if($category=='image'){
		$f=strpos($title,'.');
		if($f){
			header('Content-type: video/'.$type); 
			header('Content-Disposition: attachment; filename='.$title);
			header("Content-Length: ". $size);
			readfile("$title");
		} else {
			header('Content-type: video/'.$type); 
			header('Content-Disposition: attachment; filename='.$title.'.'.$type);
			header("Content-Length: ". $size);
			readfile("$title.$type");
		}
	} else {
	      $f=strpos($title,'.');
		if($f){
			header('Content-type: Image/'.$type); 
			header('Content-Disposition: attachment; filename='.$title);
			header("Content-Length: ". $size);
			readfile("$title");
		} else {
			header('Content-type: Image/'.$type); 
			header('Content-Disposition: attachment; filename='.$title.'.'.$type);
			header("Content-Length: ". $size);
			readfile("$title.$type");
		}
	  }
  

/*if ($path){
		$path = $path;
		echo "<br/> <br/> <a href='$path'> Download</a>";
	} else {
		echo "<script>
		alert('Sorry, this media cannot be downloaded!!!');
		</script>";
	}
*/?>
