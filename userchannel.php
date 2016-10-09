<?php
session_start();
include 'connect_database.php';
?>
<html>
    <head>
        <style>

            #contacts
            {
                font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
                width:100%;
                border-collapse:collapse;
                text-align:center;
            }
            #contacts td, #contacts th 
            {
                font-size:1em;
                border:1px solid #FF9900;
                padding:3px 7px 2px 7px;
                text-align:center;
            }
            #contacts th 
            {
                font-size:1.2em;
                text-align:left;
                padding-top:5px;
                padding-bottom:4px;
                background-color:#FF6600;
                color:#fff;
                text-align:center;
            }
            #contacts tr.alt td 
            {
                color:#000;
                background-color:#FFCC99;
                text-align:center;
            }

        </style>

    </head>
    <body>     
        <div>  
            <table id="contacts">
                <tbody>
                    <tr>


                <br>                              
                <?php
                $email = $_SESSION["eml"];
                $usenm = $_SESSION["useName"];
                $useid = $_SESSION["userid"];
                if ($useid == 0 || $useid == "") {
                    echo "<h2 style='font-family:Helvetica; color:indigo'>";
                    echo "Sorry. You have to log in first.</h2>";
                } else {

                    //echo $useid;
                    if (isset($_GET["id"])): {
                            $id = $_GET["id"];

                            //check if is user's foe
                            $sql1 = "SELECT * FROM foe WHERE user_id='$id' && foe_id='$useid'";
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                                echo "<h2 style='font-family:Helvetica; color:indigo'>"
                                . "Sorry, you are not allowed to browse this user's channel.</h2>";
                            } else {
                                $sql = "SELECT username FROM User WHERE user_id='$id'";
                                $result = $conn->query($sql);
                                $info = $result->fetch_assoc();
                                $name = $info["username"];
                                //echo $name;
                                $sql1 = "SELECT * FROM media WHERE upload_user='$id'";
                                $result1 = $conn->query($sql1);
                                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    echo"
                         <h2 style='font-family:Helvetica; color:indigo; text-align: center'>$name's UPLOAD
                        </tr>
                <tr>
                    <th>#</th>
                    <th>Media Name</th>
                    <th>Upload Time</th>
                    <th>Category</th>
                    <th>Viewed Time</th>
                    <th>Rate</th>
                </tr>";

                                    $self = $_SERVER["PHP_SELF"];
                                    $i = 1;
                                    while ($row = $result1->fetch_assoc()) {
                                        $meid = $row["media_id"];
                                        if ($i % 2 == 1) {
                                            //upload information
                                            echo "
                <tr>
                    
                    <th scope='row'>$i</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['upload_time'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['view_time'] . "</td>
                    <td>" . $row['rate'] . "</td>";
                                        }
                                        if ($i % 2 == 0) {
                                            //upload information
                                            echo "
                <tr>
                    
                    <th scope='row'>$i</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['upload_time'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['view_time'] . "</td>
                    <td>" . $row['rate'] . "</td>";
                                        }
                                        $i++;
                                    }
                                } else {
                                    echo "You haven't upload any media.";
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>


                    <!-- User's Favorite List -->
                    <br>
                    <div>
                        <table id="contacts">
                            <tbody>
                                <tr>
                                    <?php
                                    $sql2 = "SELECT User_ID, Media_ID FROM Favorite_List WHERE User_ID='$id'";
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        // output data of each row
                                        echo"
                         <h2 style='font-family:Helvetica; color:indigo; text-align: center'>$name's FAVORITE LIST
                        </tr>
                 <tr>
                    <th>#</th>
                    <th>Media Name</th>                                      
                </tr>";
                                        $favinfo = $result2->fetch_assoc();
                                        //$self = $_SERVER["PHP_SELF"];
                                        $i = 1;
                                        $meid = $favinfo["Media_ID"];
                                        $sql3 = "SELECT media_id, title FROM media WHERE media_id='$meid'";
                                        $meinfo = $conn->query($sql3);
                                        $info = $meinfo->fetch_assoc();

                                        $meid = $row["media_id"];
                                        if ($i % 2 == 1) {
                                            //media information
                                            echo "
                <tr>
                    <form method='post' action='myfav.php'>
                    <th scope='row'>$i</th>
                    <td>" . $info['title'] . "</td>";
                                        }
                                        if ($i % 2 == 0) {
                                            //media information
                                            echo "
                <tr class='alt'>
                    <form method='post' action='myfav.php'>
                    <th scope='row'>$i</th>
                    <td>" . $info['title'] . "</td>";
                                        }
                                        //echo $_GET['block'];
                                        $i++;
                                    }
                                    ?>
                            </tbody>
                        </table>                      
                    </div>

                    <!-- User's Play List -->
                    <br>
                    <div>
                        <table id="contacts">
                            <tbody>
                                <tr>
                                    <?php
                                    $sql4 = "SELECT * FROM user_playlist WHERE user_id='$id'";
                                    $result4 = $conn->query($sql4);
                                    if ($result4->num_rows > 0) {
                                        echo "<h2 style='font-family:Helvetica; color:indigo; text-align: center'>$name's PLAYLIST";
                                        while ($plinfo = $result4->fetch_assoc()) {
                                            echo "
                                    <table id='contacts'>
                <tbody>
                    
                                    <tr>
                            <h4 style='font-family:Helvetica; color: indigo; text-align: center' >"
                                            . $plinfo["playlist_name"];

                                            //play this list
                                            $plid = $plinfo["playlist_id"];
                                            echo "
                                    &nbsp
                                <a title='video' href='play.php? id=$plid' target='_self'>PLAY THIS LIST</a></h4>";

                                            //echo $plid;
                                            $sqlpl = "SELECT * FROM playlist_media WHERE playlist_id='$plid'";
                                            $resultpl = $conn->query($sqlpl);
                                            if ($resultpl->num_rows > 0) {
                                                // echo "hello";
                                                $i = 1;
                                                echo " 
                    <th>#</th>
                    <th>Media Name</th>                                      
                    <th>Play</th>
                            </tr>";
                                                while ($infomedia = $resultpl->fetch_assoc()) {
                                                    $plmeid = $infomedia["media_id"];
                                                    $sqlme = "SELECT media_id, title FROM media WHERE media_id='$plmeid'";
                                                    $meinfo = $conn->query($sqlme);
                                                    $infop = $meinfo->fetch_assoc();
                                                    if ($i % 2 == 1) {
                                                        //media information
                                                        echo "
                <tr>
                    <form method='post' action='myplaylist.php'>
                    <th scope='row'>$i</th>
                    <td>" . $infop['title'] . "</td>";


                                                        //play playlist
                                                        echo
                                                        "<form method='post' action='video.php? id=$plmeid'>
                                <td>                                                  
                    <input  type='submit' value='PLAY'></input></form>
                    </td>
                    
                </tr>";
                                                    }
                                                    if ($i % 2 == 0) {
                                                        echo "
                <tr>
                    <form method='post' action='myplaylist.php'>
                    <th scope='row'>$i</th>
                    <td>" . $infop['title'] . "</td>";


                                                        //play playlist
                                                        echo
                                                        "<form method='post' action='video.php? id=$plmeid'>
                                <td>                                                  
                    <input  type='submit' value='PLAY'></input></form>
                    </td>
                    
                </tr>";
                                                    }
                                                    //echo $_GET['block'];
                                                    $i++;
                                                }
                                                echo "</tbody></table>";
                                            }
                                        }
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>


        <?php
    else: {
            echo "Error: Unable to obtain this user's channel.";
        }
    endif;
}
$conn->close();
?>
    </body>
</html>
