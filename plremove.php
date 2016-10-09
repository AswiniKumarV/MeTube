<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
          
            h3{
                font-family: verdana;
                color:indigo;
                text-align: left;
            }
        </style> 
    </head>
    <body>
        <div class="player">
            <?php
            $useid = $_SESSION["userid"];
            if (isset($_GET["id"])) {
                //echo $_GET["id"];
                if(isset($_GET["plid"])){
                   $mediaid = $_GET["id"]; 
                   $plid=$_GET["plid"];
                   $sql = "DELETE FROM playlist_media WHERE media_id=$mediaid && playlist_id=$plid";
                   $result=$conn->query($sql);
                   if($result){
                       echo "<h3>You have successfully deleted this media from your playlist.</h3>";
                       $sqlpl = "SELECT * FROM playlist_media WHERE playlist_id='$plid'";
                        $resultpl = $conn->query($sqlpl);
                        if ($resultpl->num_rows > 0) {
						    $sqlp="0";	//do nothing
						}else{
							$sqlp="DELETE FROM user_playlist WHERE playlist_id=$plid";
							$resultp = $conn->query($sqlp);
						}
                       
                   }else{
                       echo "Error when deleting media.";
                   }
                }
            }else{
                echo"Error.";
            }
            echo "<h3><a href='myplaylist.php?id=$useid' target='_self'>Check out my play list.</a></h3>";
                
