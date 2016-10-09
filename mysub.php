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
                <h2 style="font-family:Helvetica; color: indigo; text-align: center" >MY SUBSCRIBE
                    <!-- Add contacts--><form method="post" action="mysub.php" class="_self">
                                           
                <?php               
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT user_id, channel_id FROM subscribe_channel WHERE user_id='$useid'";
                $result = $conn->query($sql);
               
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "</tr>
                <tr>
                    <th>#</th>
                    <th>Channel Name</th>                                      
                    <th>Unsubscribe</th>
                </tr>";
                    $self = $_SERVER["PHP_SELF"];
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $chid = $row["channel_id"];            
                        $sql = "SELECT * FROM channel WHERE channel_id='$chid'";
                        $meinfo = $conn->query($sql);
                        $info = $meinfo->fetch_assoc();
                        //$sqlblock = "SELECT user_id, block_user_id FROM block_user WHERE user_id='$useid' && block_user_id='$conid'";
                        //$resultbl = $conn->query($sqlblock);
                        if ($i % 2 == 1) {
                            //channel information
                            echo "
                <tr>
                    <form method='post' action='mysub.php'>
                    <th scope='row'>$i</th>
                   <td><a href='chmedia.php?id=$chid' target='_self'>" . $info['title'] . "<a></td>";
                    

                            //Unsubscribe
                            echo
                            "<form method='post' action='mysub.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Unsubscribe'></input></form>
                    </td>
                    
                </tr>";
                if(isset($_POST["remove$i"])){
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM subscribe_channel WHERE user_id=$useid && channel_id=$chid";
                                $conn->query($sql);
                                echo "<script>alert('You have successfully unsubscribed!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;
                        }
					}
                        if ($i % 2 == 0) {
                        //channel information
                            echo "
                <tr class='alt'>
                    <form method='post' action='mysub.php'>
                    <th scope='row'>$i</th>
                    <td><a href='chmedia.php?id=$chid' target='_self'>" . $info['title'] . "<a></td>";
                    

                            //Unsubscribe
                            echo
                            "<form method='post' action='mysub.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Unsubscribe'></input></form>
                    </td>
                    
                </tr>";
                if(isset($_POST["remove$i"])){
                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM subscribe_channel WHERE user_id=$useid && channel_id=$chid";
                                $conn->query($sql);
                                echo "<script>alert('You have successfully unsubscribed!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
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
