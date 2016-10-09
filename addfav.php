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
            
            if(isset($_SESSION["userid"])){
            $useid = $_SESSION["userid"];
            if(isset($_GET["id"])){
            $mediaid = $_GET["id"];
            $sql = "SELECT * FROM media WHERE media_id=$mediaid";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $name = $row["title"];
            $type = $row["type"];

            //Add to favorite list
            $sqlcheck = "SELECT * FROM Favorite_List WHERE User_ID=$useid && Media_ID=$mediaid";
            $resultck = $conn->query($sqlcheck);
            $rowck = $resultck->fetch_assoc();
            if($resultck->num_rows>0){
            echo "<h4 style='font-family: verdana; color:indigo; text-align: center'>"
                . "This media is already in your favorite list.<br>
                 <a href='myfav.php?id=$useid' target='_self'>Check out my favorite list.</a></h4>";
            }
            else{
            $sqladd = "INSERT INTO Favorite_List(User_ID,Media_ID) VALUES ('$useid', '$mediaid')";
            if($conn->query($sqladd) === TRUE){
            echo
            "
                      <h4 style='font-family: verdana; color:indigo; text-align: center'>
                 You have successfully added $name.<br><br>
                      <a href='myfav.php?id=$useid' target='_self'>Check out my favorite list.</a>
                          
                          </h4>                     
                      </div>
                 ";
            }
            }
            }
            
            else{
            echo "Error!";
            }

            }
            else{
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




