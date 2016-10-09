<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
            videoskin
            { 
                background: rgba(158,72,72,0.7);
            }

        </style> 
    </head>
    <body>
        <div class="player">
            <?php
            //echo $_GET["id"];
            if (isset($_GET["id"])) {
                $plstid = $_GET["id"];
                $sql = "SELECT * FROM playlist_media WHERE playlist_id='$plstid'";
                $resultpl = $conn->query($sql);
                if ($resultpl->num_rows > 0) {
                    $_SESSION["num"]=$resultpl->num_rows;
                   // $_SESSION["infomedia"] = $resultpl->fetch_assoc();
                    $_SESSION["i"]=0;
                    $j=0;
                    while ($infomedia = $resultpl->fetch_assoc()) {
                        $arr[$j]=$infomedia["media_id"];                     
                        $j++;                                                             
                    }
                    $_SESSION["arr"]=$arr;
                } else {
                    echo "Error!";
                }
            }
            //echo $arr[0];
            //echo $arr[1];
            ?>
           <script> location.href='playlist.php';</script>
        </div>    
    </body>




