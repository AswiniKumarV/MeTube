<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
             h4{ 
                font-family: verdana; 
                color:indigo; 
                text-align:center;
            }
        </style> 
    </head>
    <body>
        <div>
<?php
if(isset($_SESSION["userid"])){
$useid = $_SESSION["userid"];
$plstname=$_POST["plname"];
//echo "thank you";
//echo $plstname;
if($plstname){
//check if name exist.
$sqlck="SELECT * FROM user_playlist WHERE user_id='$useid' AND playlist_name='$plstname'";
$resultck=$conn->query($sqlck);
if ($resultck->num_rows > 0) {
            echo "<h4 style='font-family: verdana; color:indigo; text-align: center'>"
            . "This playlist name already exists. Try another one.<br>
                 <a href='newpl.php' target='_self'>Return.</a></h4>";
            } else {
                //echo "else";
                $mediaid=$_SESSION["meid"];
                $sqladd = "INSERT INTO user_playlist(user_id,playlist_name) VALUES ('$useid', '$plstname')";
            if($conn->query($sqladd) === TRUE){
                //echo "true";
                $sql="SELECT * FROM user_playlist WHERE user_id='$useid' AND playlist_name='$plstname'";
                $result=$conn->query($sql);                
                if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $plid=$row["playlist_id"];
                //echo $plid;
                $sqladme="INSERT INTO playlist_media(media_id,playlist_id) VALUES ('$mediaid', '$plid')";
                if ($conn->query($sqladme) === TRUE) {
            echo
            "
                      <h4 style='font-family: verdana; color:indigo; text-align: center'>
                 You have successfully added the media to your new list.<br><br>
                      <a href='myplaylist.php?id=$useid' target='_self'>Check out my play list.</a>
                          
                          </h4>                     
                      </div>
                 ";
            }else{
                echo"Error when inserting to the database.";
            }
            
                }else{
                    echo "Error!";
                }
            }
}
}else{
	echo "<h4>Playlist name cannot be empty.<br><br><br>";
	echo "<a href='newpl.php?' target='_self'>Try again.</a></h4>";
}
}else{
    echo "Error! You have to log in.";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

