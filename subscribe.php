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
            }
        </style> 
    </head>
    <body>
        <div class="player">

            <?php
            if (isset($_SESSION["userid"])) {
                if (isset($_GET["chid"])) {
                    //echo $_GET["chid"];
                    $_SESSION["chid"] = $_GET["chid"];
                    $chid = $_GET["chid"];
                    $useid = $_SESSION["userid"];                   

                    //check if subscribed
                    $sqlcheck = "SELECT * FROM subscribe_channel WHERE channel_id='$chid' AND user_id='$useid'";
                    $resultck = $conn->query($sqlcheck);
                    $rowck = $resultck->fetch_assoc();
                    if ($resultck->num_rows > 0) {
                        echo "<h4 style='font-family: verdana; color:indigo; text-align: center'>"
                        . "You have already subscribed to this channel.<br>
                 <a href='mysub.php?id=$useid' target='_self'>Check out my subscribed channel.</a></h4>";
                    } else {
                        //echo 'else';
                        $sqladd = "INSERT INTO subscribe_channel(user_id,channel_id) VALUES ('$useid', '$chid')";
                        if ($conn->query($sqladd) === TRUE) {
                            echo
                            "
                      <h4 style='font-family: verdana; color:indigo; text-align: center'>
                 You have successfully subscribed to this channel.<br><br>
                      <a href='mysub.php?id=$useid' target='_self'>Check out my subscribed channel.</a>
                          
                          </h4>                     
                      </div>
                 ";
                        }else{
                            echo "<h4>Error when inserting into database.</h4>";
                        }
                    }
                } else {
                    echo "Error!";
                }
            } else {
                echo"<h3 style='font-family: verdana; color:indigo; text-align: center'>
                Sorry. You have to log in first.</h3>";
            }
            ?>




    </body>
</html>




