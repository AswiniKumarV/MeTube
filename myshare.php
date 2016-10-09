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

        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>     
        <div>  
            <table id="contacts">
                <tbody>
                    <tr>
                <h2 style="font-family:Helvetica; color: indigo; text-align: center" >Mediums Shared To Me
                    <form method="post" action="myshare.php" class="_self">
                                           
                <?php               
                $useid = $_SESSION["userid"];
                
                
                //echo $useid;
                $sql = "SELECT * FROM shared_media WHERE user_id='$useid'";
                $result = $conn->query($sql);           
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "</tr>
                <tr>
                    <th>#</th>
                    <th>Media Name</th> 
                    <th>Shared By</th>                                     
                    <th>Remove</th>
                </tr>";
                    $self = $_SERVER["PHP_SELF"];
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $meid = $row["media_id"];   
                        $shusr= $row["shared_by_user_id"]; 
                        //Get user infomation
						$sqlusr = "SELECT * FROM User WHERE user_id='$shusr'";
						$resultusr = $conn->query($sqlusr);  
						$rowuse=$resultusr->fetch_assoc();
						$user=$rowuse["username"];     
						
						//Get media info
                        $sql = "SELECT * FROM media WHERE media_id='$meid'";
                        $meinfo = $conn->query($sql);
                        $info = $meinfo->fetch_assoc();
                        $type= $info["type"];
                        //$sqlblock = "SELECT user_id, block_user_id FROM block_user WHERE user_id='$useid' && block_user_id='$conid'";
                        //$resultbl = $conn->query($sqlblock);
                        if ($i % 2 == 1) {
                            //media information
                            echo "
                <tr>
                    <form method='post' action='myshare.php'>
                    <th scope='row'>$i</th>";

                                    if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "JPG" || $type == "PNG" || $type == "JPEG" || $type == "GIF" || $type == "gif") {
                                        echo "<td><a href='imshow.php?id=$meid' target='_self'>" . $info['title'] . "</a> </ul>";
                                    } else {
                                        echo "<td><a href='video.php?id=$meid' target='_self'>" . $info['title'] . "<a></td>";
                                    }
                                    
                                    echo"<td>
                                    $user
                                    </td>";
                                    
                            //Remove
                            echo
                            "<form method='post' action='myshare.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";
                if(isset($_POST["remove$i"])){
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM shared_media WHERE user_id=$useid && media_id=$meid";
                                $conn->query($sql);
                                echo "<script>alert('You have successfully removed this media!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;
                        }
					}
					
					
					 if ($i % 2 == 0) {
					
                            //media information
                            echo "
                <tr class='alt'>
                    <form method='post' action='myshare.php'>
                    <th scope='row'>$i</th>";

                                    if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "JPG" || $type == "PNG" || $type == "JPEG" || $type == "GIF" || $type == "gif") {
                                        echo "<td><a href='imshow.php?id=$meid' target='_self'>" . $info['title'] . "</a> </ul>";
                                    } else {
                                        echo "<td><a href='video.php?id=$meid' target='_self'>" . $info['title'] . "<a></td>";
                                    }
                                    
                                    echo"<td>
                                    $user
                                    </td>";
                                    
                            //Remove
                            echo
                            "<form method='post' action='myshare.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";
                if(isset($_POST["remove$i"])){
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM shared_media WHERE user_id=$useid && media_id=$meid";
                                $conn->query($sql);
                                echo "<script>alert('You have successfully removed this media!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;
                        }
					}
                        //echo $_GET['block'];
                        $i++;
                    }
				}
                
                ?>

                </tbody>
            </table>
        </div>
                <?php $conn->close();
                ?>



    </body>
</html>
