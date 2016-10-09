<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
            videoskin
            { 
                background: rgba(158,72,72,0.7);
            }
            h3{
                font-family: verdana;
                color:indigo;
                text-align: left;
            }
        </style> 
    </head>
    <body>
        <div class="player">
            <?php
           
            if (isset($_GET["id"])) {
                $mediaid = $_GET["id"];
                //echo $mediaid;
                $sql = "SELECT * FROM media WHERE media_id=$mediaid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $name = $row["title"];
                $upuser = $row["upload_user"];
                $type = $row["type"];
                $vt = $row["view_time"];
                $keywords=$row["keywords"];
                
                
                if(isset($_SESSION["userid"])){
                $useid = $_SESSION["userid"];
                
                //check if block
                $sqlblm = "SELECT * FROM foe WHERE user_id='$upuser' AND foe_id='$useid'";
                $resultbl = $conn->query($sqlblm);
                $rowbl = $resultbl->fetch_assoc();

                if ($resultbl->num_rows > 0) {
                    echo "<h3>Sorry. You are not allowed to watch this video.</h3>";
                   // $type2=".".$type;
                } else {
                    $type2=".".$type;
                    //echo $name;
                    //echo $type;
                    if ($type=='mp3') {
                        $type1 = 'mp4';
                    } else {
                        $type1 = $type;
                    }
                   // $f=strpos($name,".");
                    //echo "hello";
                   $f=strpos($name,'.');
                    if($f){
						//echo "found";
						$type2=null;
					}
					//echo "$name";
                    echo
                    "
                      <h2 style='font-family: verdana; color:indigo; text-align: center'>$name</h2>
                     <video  id='Video' controls preload='auto' width='854' height='510' autoplay>
	 <source src='$name$type2' type='video/$type1'>
         
         Your browser does not support the video tag.
	</video>
                      </div>
                 ";
                    $vt = $vt + 1;
                    $sqlview = "UPDATE media SET view_time='$vt' WHERE media_id='$mediaid'";
                    $conn->query($sqlview);

                    //share media
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>";
                    echo "<form action='share_media.php' method='get'>";
                    echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
                    echo "<input type='submit' value='Share Me!!' name='meid'>";
                    echo "</form>";
                    echo "</td>";

                    //media rating                  
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>";

// Rating a media part..............................................
// .................................................Rating part.....
                    echo "<td>";
                    echo "<form action='rate_media.php' method='get'>";
                    echo "<input type='submit' value='submit rating' name='submit'>";
                    echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
                    echo "<select name='mediarating' required>";
                    echo "<option value=''></option>";
                    echo "<option value='1'>1</option>";
                    echo "<option value='2'>2</option>";
                    echo "<option value='3'>3</option>";
                    echo "<option value='4'>4</option>";
                    echo "<option value='5'>5</option>";
                    echo "<option value='6'>6</option>";
                    echo "<option value='7'>7</option>";
                    echo "<option value='8'>8</option>";
                    echo "<option value='9'>9</option>";
                    echo "<option value='10'>10</option>";
                    echo "</select> **";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
// ............................................Rating part Ends..... 
//download
                    echo"
        <form action='download.php' method='post'>
<input type='hidden' name = 'mediaid' value = '$mediaid'>
<input type='submit' value='DOWNLOAD THIS MEDIA' />
</form></h3>";



                    $sql1 = "SELECT allow_comments FROM  media WHERE media_id='$mediaid'";
                    $result = $conn->query($sql1);
                    $row = $result->fetch_assoc();
                    $allow = $row['allow_comments'];

                    if ($allow == 1) {
                        if (isset($_SESSION["userid"])) {
                            echo"
							<form action = 'insert_comment.php' method = 'post'>
							<h3 style = 'font-family: verdana; color:indigo; text-align: left'>Comment:</h3><br />
							<textarea class = 'comments' name = 'comment' id = 'comment'></textarea><br />
							<input type = 'hidden' name = 'mediaid' value = '$mediaid'>
							<input type = 'hidden' name = 'medianame' value = '$name'>
							<input type = 'hidden' name = 'mediatype' value = '$type'>
							<input type = 'submit' value = 'Submit' />
							</form></h3>";
                        }

                        //echo $mediaid;
                        echo "<h3 style = 'font-family: verdana; color:indigo; text-align: left'>ALL COMMENTS <br /><br />";
                        $sql1 = "SELECT * FROM  Comments WHERE media_id='$mediaid' ORDER BY  time DESC ";
                        $result = $conn->query($sql1);
                        while ($row = $result->fetch_assoc()) {
                            $commentedby = $row['user_id'];

                            $query1 = "SELECT username FROM User WHERE user_id='$commentedby'";
                            $friendname = $conn->query($query1);
                            $row1 = $friendname->fetch_assoc();
                            $commentorname = $row1['username'];
                            $comtime = $row['time'];
                            $actcommnet = $row['comment'];

                            echo "$commentorname &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     $comtime <br />";
                            echo "$actcommnet <br /><br />";
                        }
                    } else {
                        echo "<br /><h3 style = 'font-family: verdana; color:indigo; text-align: left'>Comments are disabled for this item!!</h3>";
                    }
                    include 'recomendation.php';
					
				}
                
            //if have not logged in
            }else{
				//show video\
				 $type2=".".$type;
                    //echo $name;
                    //echo $type;
                    if ($type=='mp3') {
                        $type1 = 'mp4';
                    } else {
                        $type1 = $type;
                    }
                   // $f=strpos($name,".");
                    //echo "hello";
                   $f=strpos($name,'.');
                    if($f){
						//echo "found";
						$type2=null;
					}
					//echo "$name $type1";
                    echo
                    "
                      <h2 style='font-family: verdana; color:indigo; text-align: center'>$name</h2>
                     <video  id='Video' controls preload='auto' width='854' height='510' autoplay>
	 <source src='$name$type2' type='video/$type1'>
         
         Your browser does not support the video tag.
	</video>
                      </div>
                 ";
                 echo "<h3>";
                 
                  include 'recomendation.php';
                  echo "</h3>";
				}

            } else {
                echo "Error!";
            }
            ?>


    </body>




