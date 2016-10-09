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

            <h2 style="font-family:Helvetica; color: indigo; text-align: center" >MY PLAY LIST
                <!-- Add contacts    <form method="post" action="myplaylist.php" class="_self">  -->

                <?php
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT * FROM user_playlist WHERE user_id='$useid'";
                $result = $conn->query($sql);

                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    //$numpl=$result->num_rows;
                    // output data of each row                    
                    $self = $_SERVER["PHP_SELF"];
                    $j = 1;
                    while ($row = $result->fetch_assoc()) {

                        echo "
                                    <table id='contacts'>
                <tbody>
                    
                                    <tr>
                            <h4 style='font-family:Helvetica; color: indigo; text-align: center' >"
                        . $row["playlist_name"];

                        //play this list
                        $plid= $row["playlist_id"];
                        $plidtag=$plid.$j;
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
                    <th>Remove Media</th>                   
                            </tr>";
                            //<th>Play</th>
                            while ($infomedia = $resultpl->fetch_assoc()) {
                                $meid = $infomedia["media_id"];
                                $sqlme = "SELECT media_id, type, title FROM media WHERE media_id='$meid'";
                                $meinfo = $conn->query($sqlme);
                                $info = $meinfo->fetch_assoc();
                                $type=$info['type'];
                                //media information
                                echo "
                <tr>
                   
                    <th scope='row'>$i</th>";
                                
                                if($type=="jpg" || $type=="jpeg" ||$type=="png" ||$type=="JPG" ||$type=="PNG" ||$type=="JPEG"||$type=="GIF"||$type=="gif"){
                        echo "<td><a href='imshow.php?id=$meid' target='_self'>".$info['title']."</a> </ul>"; 
                    }else{
                                echo "<td><a href='video.php?id=$meid' target='_self'>" . $info['title'] . "<a></td>
                    ";}
                                $currplid = $plid;
                                
                                echo
                                "<form action='plremove.php' method='get'>
                                <td>                               
                    <input  type='hidden' name='id' value='$meid'></input>
                    <input  type='hidden' name='plid' value='$currplid'></input>
                    <input  type='submit' value='Remove'></input></form>
                    </td>"
                                . "</tr>";


                                $i++;
                            }
                            echo "</tbody></table>";
                        }
                    }
                    $j++;
                }
                ?>


        </div>
        <?php $conn->close();
        ?>



    </body>
</html>


