<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>
    <head>        
    </head>
    <body>
        <div class="playlist">
            <?php
            //echo"here is playlist";
            //echo $_SESSION["num"];
            //echo $_SESSION["i"];
            $i=$_SESSION["i"];
            $info=$_SESSION["arr"];
            //echo $info[0];
            //echo $info[1];
            if ($i<$_SESSION["num"]) {
                $medi=$info[$i];
                echo "<script> location.href='plstprocess.php?id=$medi';</script>";
                
                } else {
                    echo "<script>alert('Playlist ended!');location.href='channel.php';</script>";
                }
            
            ?>
            