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
                text-align:center;
            }
        </style> 
    </head>
    <body>
        <div>

            <?php
            if (isset($_SESSION["userid"])) {
                    echo "<h3>Please select a channel for the media you want to upload:";
                    //Choose a play list
                    $useid = $_SESSION["userid"];
                    $sqlpl = "SELECT * FROM channel WHERE user_id=$useid";
                    $resultpl = $conn->query($sqlpl);
                    //$rowpl = $resultpl->fetch_assoc();
                    //$plid = $rowpl["playlist_id"];
                    if ($resultpl->num_rows > 0) {
                        echo"
                            <form method='post' action='htmlupload.php' target='_self'>
                         <select name='upch' required><option></option>";
                        while ($rowpl = $resultpl->fetch_assoc()) {
                            $chname = $rowpl["title"];
                            $chid = $rowpl["channel_id"];
                            echo"<option value='$chid'>$chname</option>";
                        }
                        echo "</select>"
                        . "<br><input type='submit'></input></form>";
                    } else {
                        echo "You don't have any channel yet.";                       
                    }
                    echo "<br><br><a href='newch.php' target='_self'>Create a channel.</a>";
                
            } else {
                echo"<h3 style='font-family: verdana; color:indigo; text-align: center'>
                Sorry. You have to log in first.</h3>";
            }
            ?>

        </h3>
    </div>
</body>
</html>