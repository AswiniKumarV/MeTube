<?php
session_start();
include 'connect_database.php';

?>
<html>
    <head>
        <style>
            h2{
                font-family:verdana;
                color:indigo;
            }
            
            #vedio
            {
                font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
                width:100%;
                border-collapse:collapse;
                text-align:center;
            }
        </style>
    </head>
    <body>
        
        <h1 style="font-family: verdana; color:indigo; text-align: center">Images
        </h1>
        <form method="post" action="search.php" target="_self">
            <input type="submit"  value="SEARCH" ></input>
        </form>
        <h2>      
       <table id="vedio">
            <tr>
                <?php
                //select movies from database
                
                $sql = "SELECT * FROM media WHERE category='image'";
                //echo $sql;
                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $num=$result->num_rows;
                //echo $num;
                if($num > 0){
                    $t=0;
                    while($row = $result->fetch_assoc()) {
                        $title=$row["title"];
                        $medi=$row["media_id"];
                        $upt=$row["upload_time"];
                        $vt=$row["view_time"];
                        $rate=$row["rate"];
                        $upuser=$row["upload_user"];
                        $type=$row["type"];
                        $chnl=$row["channel_id"];
                     //Get channel information
                        $sqlch="SELECT * FROM channel WHERE channel_id='$chnl'";
                        $resultch = $conn->query($sqlch);
                        $chinfo = $resultch->fetch_assoc();
                        $chname=$chinfo["title"];
                    //Get user information
                        $sqluser="SELECT user_id, username FROM User WHERE user_id='$upuser'";
                        $resultuser = $conn->query($sqluser);
                        $userinfo = $resultuser->fetch_assoc();
                        $usename=$userinfo["username"];
                    if ($t % 3 == 0) {
                        echo "<tr>";
                        $tem=$t;
                    }

                    echo "
                 <td>
            
                <ul>
                <ul><img src='images.jpg' alt='".$title."'/></ul>
                   
                        <ul><a title='image' href='imshow.php? id=$medi' target='_self'>".$title."</a> </ul>
                    <ul>                    
                        Upload User:<a href='userchannel.php?id=$upuser' target='_self'>".$usename."</a>
                    </ul>
                    <ul>Upload Time:<br>".$upt."</ul>
                    <ul >Viewed Times:".$vt."</ul>
                    <ul >Rate:".$rate."</ul>
                    <ul title='Add to list'><a href='addfav.php?id=$medi' target='_self'>Add to Favorite</a></ul>
                   <ul>Channel:$chname<br><a href='subscribe.php?chid=$chnl' target='_self'>Subscribe</a></ul>
                    <ul><a href='share_media.php?mediaid=$medi' target='_self'>Share</a></ul>
                </ul>
               </td>
            </div>
        
                            ";
                    if ($t % 3 == 0 && $t>$tem) {
                        echo "</tr>";
                    }
                    $t++;
                }
                }
                else{
                    echo "<h2>There is no media in this category yet.</h2>";
                }
                ?>
            </tr>
        </table>
    </body>
</html>



