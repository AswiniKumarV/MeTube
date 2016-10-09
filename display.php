               <?php if($num > 0){
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
                        $rate=$row["rate"];
                    //Get user information
                        $sqluser="SELECT user_id, username FROM User WHERE user_id='$upuser'";
                        $resultuser = $conn->query($sqluser);
                        $userinfo = $resultuser->fetch_assoc();
                        $usename=$userinfo["username"];
                    //Get channel information
                        $sqlch="SELECT * FROM channel WHERE channel_id='$chnl'";
                        $resultch = $conn->query($sqlch);
                        $chinfo = $resultch->fetch_assoc();
                        $chname=$chinfo["title"];
                        
                    if ($t % 3 == 0) {
                        echo "<tr>";
                        $tem=$t;
                    }

                    echo "
                <td>
            
                <ul>
                    
                    <ul><img src='images.jpg' alt='".$title."'/></ul>                                      
                    <ul></ul>";
                    
                    if($type=="jpg" || $type=="jpeg" ||$type=="png" ||$type=="JPG" ||$type=="PNG" ||$type=="JPEG"||$type=="GIF"||$type=="gif"){
                        echo "<ul><a title='image' href='imshow.php? id=$medi' target='_self'>".$title."</a> </ul>"; 
                    }else{
                    echo "<ul><a title='video' href='video.php? id=$medi' target='_self'>".$title."</a> </ul>"; }                  

                    echo"
                    <ul>                    
                        Upload User:<a href='userchannel.php?id=$upuser' target='_self'>".$usename."</a>
                    </ul>
                    <ul>Upload Time:<br>".$upt."</ul>
                    <ul >Viewed Times:".$vt."</ul>
                    <ul >Rate:".$rate."</ul>
                    <ul title='Add to favorite'><a href='addfav.php?id=$medi' target='_self'>Add to Favorite</a></ul>";
                                             
                    //Only video can be add to play list.
                    if($type=="mp4" || $type=="ogg" ||$type=="webm" ||$type=="MP4" ||$type=="OGG" ||$type=="WEBM"){
                        echo " <ul><a href='addplpro.php?id=$medi' target='_self'>Add to Playlist</a></ul>";
                    }
                                      
                    echo "<ul>Channel:$chname<br><a href='subscribe.php?chid=$chnl' target='_self'>Subscribe</a></ul>
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
                    echo "<h3 style='font-family: verdana; color:indigo; text-align: center'>No results found!</h3>";
                }
                ?>
