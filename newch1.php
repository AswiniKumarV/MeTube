<?php
session_start();
include 'connect_database.php';
?>
<!doctype html>
<html>

    <head>
        <style type="text/css">
             h4{ 
                font-family: verdana; 
                color:indigo; 
                text-align:center;
            }
        </style> 
    </head>
    <body>
        <div>
<?php
if(isset($_SESSION["userid"])){
$useid = $_SESSION["userid"];
$chname=$_POST["chname"];
//echo "thank you";
//echo $plstname;
if($chname){
//check if name exist.
	$sqlck="SELECT * FROM channel WHERE user_id='$useid' AND title='$chname'";
	$resultck=$conn->query($sqlck);
	if ($resultck->num_rows>0) {
            echo "<h4 style='font-family: verdana; color:indigo; text-align: center'>"
            . "This channel name is already exist. Try another one.<br>
                 <a href='newch.php' target='_self'>Return.</a></h4>";
            } else {
                $sqladd="INSERT INTO channel(user_id,channel_id,title) VALUES ('$useid','','$chname')";
                //$sqladd="INSERT INTO channel(user_id,channel_id,title) VALUES ('1','','1')";
                $resultadd=$conn->query($sqladd);
            if($resultadd){
                //echo "true";
                $sql="SELECT * FROM channel WHERE user_id LIKE'$useid' AND title LIKE'$chname'";
                $result=$conn->query($sql);                
                if($result){
                $row=$result->fetch_assoc();
                $chid=$row["channel_id"];
                $_SESSION["ch"]=$chid;
                //$sqladme="UPDATE media SET channel_id='$chid' WHERE media_id='$mediaid'";
               
				echo
				"
                      <h4 style='font-family: verdana; color:indigo; text-align: center'>
                 You have successfully created your new channel.<br><br>
                      <a href='chl.php?' target='_self'>Return to choose a channel.</a>
                          
                          </h4>                     
                      </div>
                 ";
				}else{
					echo"<h4>Error when inserting to the database.</h4>";
				}
            
              
            }
           else{
                    echo "Error!";
                } 
}
}else{
	echo "<h4>Channel name cannot be empty.<br><br><br>";
	echo "<a href='newch.php?' target='_self'>Try again.</a></h4>";
}
}else{
    echo "Error! You have to log in.";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

