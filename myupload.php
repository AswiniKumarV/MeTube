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
                 <!-- My Upload -->        
                <div>     
                <h2 style="font-family:Helvetica; color:indigo; text-align: center">MY UPLOAD
                    <!-- Add contacts--><form method="post" action="chl.php" class="_self">
                    <input  type="submit"  value="UPLOAD MEDIA"></input></h2>
                <input type="hidden" name="up" value="1"> <!-- UPLOAD -->               
                </form>
                <br>                              
                <?php
                $email = $_SESSION["eml"];
                $usenm = $_SESSION["useName"];
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT * FROM media WHERE upload_user='$useid'";
                $result = $conn->query($sql);              
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                    echo"
                        </tr>
                <tr>
                    <th>#</th>
                    <th>Media Name</th>
                    <th>Upload Time</th>
                    <th>Category</th>
                    <th>Viewed Time</th>
                    <th>Rate</th>
                    </tr>";
                    //<th>Remove Media</th>
                

                    $self = $_SERVER["PHP_SELF"];
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $meid=$row["media_id"]; 
                        $type=$row["type"];
                        if ($i % 2 == 1) {
                            //contact information
                            
                    echo "
                <tr>
                    <form method='post' action='myupload.php'>
                    <th scope='row'>$i</th>";

                                    if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "JPG" || $type == "PNG" || $type == "JPEG" || $type == "GIF" || $type == "gif") {
                                        echo "<td><a href='imshow.php?id=$meid' target='_self'>" . $row['title'] . "</a> </ul>";
                                    } else {
                                        echo "<td><a href='video.php?id=$meid' target='_self'>" . $row['title'] . "<a></td>";
                                    }
                    echo "<td>" . $row['upload_time'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['view_time'] . "</td>
                    <td>" . $row['rate'] . "</td>";

                            //remove media
                           /* echo
                            "<form method='post' action='myupload.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";
                            
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM media WHERE upload_user=$useid && media_id=$meid";
                                $conn->query($sql);
                                echo "<script>alert('Your media is successfully Deleted!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;*/
                        }
                        if ($i % 2 == 0) {
                                       //contact information
                            //contact information
                            echo "
                <tr class='alt'>
                    <form method='post' action='myupload.php'>
                    <th scope='row'>$i</th>";

                                    if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "JPG" || $type == "PNG" || $type == "JPEG" || $type == "GIF" || $type == "gif") {
                                        echo "<td><a href='imshow.php?id=$meid' target='_self'>" . $row['title'] . "</a> </ul>";
                                    } else {
                                        echo "<td><a href='video.php?id=$meid' target='_self'>" . $row['title'] . "<a></td>";
                                    }
                    echo "<td>" . $row['upload_time'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['view_time'] . "</td>
                    <td>" . $row['rate'] . "</td>";

                            //remove media
                            /*echo
                            "<form method='post' action='myupload.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";
                            
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM media WHERE upload_user=$useid && media_id=$meid";
                                $conn->query($sql);
                                echo "<script>alert('Your media is successfully Deleted!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;*/
                        }
                        //echo $_GET['block'];
                        $i++;
                    }
                }
                else{
                    echo "You haven't upload any media.";
                }
                
                ?>
        

                </tbody>
            </table>
        </div>
                <?php $conn->close();
                ?>



    </body>
</html>
