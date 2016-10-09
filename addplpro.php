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
				$userid=$_SESSION["userid"];
                if (isset($_GET["id"])) {
                    $_SESSION["meid"]=$_GET["id"];
                    $mediaid=$_SESSION["meid"];
                    $sql1 = "SELECT * FROM media WHERE media_id=$mediaid";
                    $resultt = $conn->query($sql1);
                    while($row = $resultt->fetch_assoc()){
                    $upuser=$row["upload_user"];}
                    
                    //check if block
                    $sqlbl="SELECT * FROM foe WHERE user_id='$upuser' AND foe_id='$userid'";
                    $resultbl = $conn->query($sqlbl);
                    $rowbl = $resultbl->fetch_assoc();

                if ($resultbl->num_rows > 0) {
                    echo "<h3>Sorry. You are not allowed add this video to playlists.</h3>";
                } else{
                    echo "<h3>Please select an existing Play List:";
                    //Choose a play list
                    $useid = $_SESSION["userid"];
                    $sqlpl = "SELECT * FROM user_playlist WHERE user_id=$useid";
                    $resultpl = $conn->query($sqlpl);
                    //$rowpl = $resultpl->fetch_assoc();
                    //$plid = $rowpl["playlist_id"];
                    if ($resultpl->num_rows > 0) {
                        echo"
                            <form method='post' action='addpl.php' target='_self'>
                         <select name='playlist' required><option></option>";
                        while ($rowpl = $resultpl->fetch_assoc()) {
                            $plname = $rowpl["playlist_name"];
                            $plid = $rowpl["playlist_id"];
                            echo"<option value='$plid'>$plname</option>";
                        }
                        echo "</select>"
                        . "<br><input type='submit'></input></form>";
                    } else {
                        echo "You don't have any play list yet.";
                    }
                    echo "<br><br><a href='newpl.php' target='_self'>Add a new Play List</a>";
                
			}
                
                } else {
                    echo "Error!";
                }
            } else {
                echo"<h3 style='font-family: verdana; color:indigo; text-align: center'>
                Sorry. You have to log in first.</h3>";
            }
            ?>

        </h3>
    </div>
</body>
</html>
