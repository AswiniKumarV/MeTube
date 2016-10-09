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
}?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
             h2{ 
                font-family: verdana; 
                color:indigo; 
                text-align:center;
            }
        </style> 
    </head>
    <body>


<?php
$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(basename($_FILES["fileToUpload"]["name"]==null)){
	echo "<h2>File name can't be empty </h2>";
	
} else {
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "<h2>File already exists with this name.<br></h2>";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000000000) {
		echo "<h2>Sorry, your file is too large.</h2>";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "mp3" && $imageFileType != "MP3") {
		echo "<h2>Sorry, only mp3 files are allowed.</h2>";
		$uploadOk = 0;
	}
			// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "<h2>Sorry, your file was not uploaded.</h2>";
				// if everything is ok, try to upload file
	} else {
		$title = $target_file;
		$category = $_POST['category'];
		$uploadtime = date("Y-m-d G-i-s");
		$view_time = $rate = $rate_time = 0;
		$uploaded_user = $_SESSION["userid"];
		$type = $imageFileType;
		$size = $_FILES["fileToUpload"]["size"];
		$path = $title;
		$keywords = $_POST['keywords'];
		$channel=$_SESSION['upch'];
                $allow_comments = $_POST['allow_comments'];
		$sql="INSERT INTO media(media_id,title,category,upload_time,view_time,rate,rate_time,upload_user,type,size,path,keywords,channel_id,allow_comments) VALUES ('', '$title', '$category', '$uploadtime', '$view_time','$rate','$rate_time','$uploaded_user','$type','$size','$path','$keywords','$channel','$allow_comments')";
		if ((move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) && ($conn->query($sql) == TRUE)) {
			echo "<h2>\xA The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h2>";
			chmod($target_file, 0655);
		} else {
					echo "<h2>Sorry, there was an error uploading your file.</h2>";
		}
	}
        echo "<h2><A href = 'myupload.php'>Check out my upload</h2></a>";
}
