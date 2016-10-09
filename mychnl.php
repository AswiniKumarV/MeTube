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
                <h2 style="font-family:Helvetica; color: indigo; text-align: center" >MY CHANNEL
                    <!-- Add contacts      <form method="post" action="myfav.php" class="_self">-->
                                           
                <?php               
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT * FROM channel WHERE user_id='$useid'";
                $result = $conn->query($sql);
               
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "</tr>
                <tr>
                    <th>#</th>
                    <th>Channel Name</th>                                                         
                </tr>";
                    $self = $_SERVER["PHP_SELF"];
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $chid = $row["channel_id"];                                                
                        if ($i % 2 == 1) {
                            //media information
                            echo "
                <tr>
                    
                    <th scope='row'>$i</th>
                    <td><a href='chmedia.php?id=$chid' target='_self'>" . $row['title'] . "<a></td>";
                    
                        }
                        if ($i % 2 == 0) {
                           //media information
                            echo "
                <tr>
                    
                    <th scope='row'>$i</th>
                    <td><a href='chmedia.php?id=$chid' target='_self'>" . $row['title'] . "<a></td>";
                    
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
