<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">

        </style> 
    </head>
    <body>
        <div>
            <?php
            if (isset($_SESSION["userid"])) {
            $useid = $_SESSION["userid"];
            $plid = $_POST["playlist"];
            //echo $plid;
            $mediaid=$_SESSION["meid"];
            //echo $mediaid;
            $sqlcheck = "SELECT * FROM playlist_media WHERE playlist_id=$plid && media_id=$mediaid";
            $resultck = $conn->query($sqlcheck);
            $rowck = $resultck->fetch_assoc();
            if ($resultck->num_rows > 0) {
            echo "<h4 style='font-family: verdana; color:indigo; text-align: center'>"
            . "This media is already in this play list.<br>
                 <a href='myplaylist.php?id=$useid' target='_self'>Check out my play list.</a></h4>";
            } else {
            //Add to playlist
            $sqladd = "INSERT INTO playlist_media(playlist_id,media_id) VALUES ('$plid','$mediaid')";
            //$result = $conn->query($sqladd);
            if ($conn->query($sqladd) === TRUE) {
            echo
            "
                      <h4 style='font-family: verdana; color:indigo; text-align: center'>
                 You have successfully added this media.<br><br>
                      <a href='myplaylist.php?id=$useid' target='_self'>Check out my play list.</a>
                          
                          </h4>                     
                      </div>
                 ";
            }

            else{
                echo "Error when adding media to list.";
            }
            
            }

            
            } else {
            echo"<h3 style='font-family: verdana; color:indigo; text-align: center'>
                Sorry. You have to log in first.</h3>";
            }
            ?>
            <!--<video  controls
                    preload="auto" width="854" height="510" autoplay>
               <source src='$name.$type' type='video/$type'>
             <source src="php $name.php $type?>" type='video/php $type?>'>
     <source src='big_buck_bunny_480p_stereo.ogg' type='video/ogg'>
             <!--<source src="movie.ogg" type="video/ogg">
             Your browser does not support the video tag.
            </video>
    </div> -->

    </body>




