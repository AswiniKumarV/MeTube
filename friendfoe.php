<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
session_start();
include 'connect_database.php'; ?>
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
                <h2 style="font-family:Helvetica">MY FRIENDS 
                    <!-- Add friends--><form method="post" action="addfriend.php" class="current">
                <input  type="submit"  value="Add Friend"></input></h2>
                <input type="hidden" name="addfr" value="1">
                </form>
                <?php
                //$_SESSION["add"]=$_POST["addfr"];
                ?>
            </tr>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Gender</th>
                    <th>Remove Friend</th>
                </tr>
                <?php
                
                $email = $_SESSION["eml"];
                $usenm = $_SESSION["useName"];
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT user_id, friend_id FROM friend WHERE user_id='$useid'";
                $result = $conn->query($sql);
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                   
                    $self = $_SERVER["PHP_SELF"];
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                        $friendid = $row["friend_id"];
                        
                        //echo $friendid;
                    $sql = "SELECT user_id, username, email, status, gender FROM User WHERE user_id='$friendid'";
                    $frdinfo=$conn->query($sql);  
                    $info = $frdinfo->fetch_assoc();
                    if ($i % 2 == 1) {
                        echo "
                <tr>
                    
                    <th scope='row'>$i</th>
                    <td>".$info['username']."</td>
                    <td>".$info['email']."</td>
                    <td>".$info['status']."</td>
                    <td>".$info['gender']."</td>                     
                   
                    <form method='post' action='friendfoe.php'>
                    <td>
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' value='Remove'></input>
                    </td>
                    </form>
                </tr>";//remove a friend
                         if (isset($_POST["remove$i"])){
                            if($_POST["remove$i"]==1)
                            {
                                $sql="DELETE FROM friend WHERE user_id=$useid && friend_id=$friendid";
                                $conn->query($sql);
                                echo "<script>alert('Your friend is successfully Deleted!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                            }
                            $_POST["remove"]=0;  
						}

                    }
                    if ($i % 2 == 0) {
                        echo "
                <tr class='alt'>
                
                    <th scope='row'>$i</th>
                    <td>".$info['username']."</td>
                    <td>".$info['email']."</td>
                    <td>".$info['status']."</td>
                    <td>".$info['gender']."</td>
                     
                      
                    <form method='post' action='friendfoe.php'>
                    <td>
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' value='Remove'></input>
                    </td>
                    </form>
                </tr>
                ";
                      if (isset($_POST["remove$i"])){
                            if($_POST["remove$i"]==1)
                            {
                                $sql="DELETE FROM friend WHERE user_id=$useid && friend_id=$friendid";
                                $conn->query($sql);
                                echo "<script>alert('Your friend is successfully Deleted!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                            }
                            $_POST["remove$i"]=0;  
						}
                    
                    }
                    //echo $_GET['block'];
                    $i++;
                        
                }
                }
                
                ?>

                </tbody>
            </table>
        </div><!-- /example -->

        <div>  
            <table id="contacts" style="right">
                <tbody>
                    <tr>
                <h2 style="font-family:Helvetica">MY FOES  
            <form mechod="post" action="addfoe.php" class="current">
            <input  type="submit" value="Add Foes"></input></h2>
                <input type="hidden" name="addfoe" value="1">
                </form>    
            </tr>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Remove Foe</th>
                </tr>
                <?php
                
                //echo $useid;
                $sql = "SELECT user_id, foe_id FROM foe WHERE user_id='$useid'";
                $result = $conn->query($sql);
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row
                   
                    
                    $j=1;
                    while ($row = $result->fetch_assoc()) {
                        $foeid = $row["foe_id"];
                        
                        //echo $friendid;
                    $sql = "SELECT user_id, username, email, status,gender FROM User WHERE user_id='$foeid'";
                    $foeinfo=$conn->query($sql);  
                    $infof = $foeinfo->fetch_assoc();
                    if ($j % 2 == 1) {
                        echo "
                <tr>
                    <form method='post' action='friendfoe.php'>
                    <th scope='row'>$j</th>
                    <td>".$infof['username']."</td>
                    <td>".$infof['email']."</td>
                    <td>".$infof['gender']."</td>
                    

                    <td>
                    <input  type='hidden' name='removef$j' value='1'></input>
                    <input  type='submit' value='Remove'></input>
                    </td>
                    </form>
                </tr>";//remove a friend
                         if (isset($_POST["removef$j"])){
                            if($_POST["removef$j"]==1)
                            {
                                $sql="DELETE FROM foe WHERE user_id=$useid && foe_id=$foeid";
                                $conn->query($sql);
                                echo "<script>alert('Your foe is successfully Deleted!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                            }
                            $_POST["removef$j"]=0;  
						}

                    }
                    if ($j % 2 == 0) {
                        echo "
                <tr class='alt'>
                
                    <th scope='row'>$j</th>
                    <td>".$infof['username']."</td>
                    <td>".$infof['email']."</td>
                    
                    <td>".$infof['gender']."</td>
                     
                    
                    <form method='post' action='friendfoe.php'>
                    <td>
                    <input  type='hidden' name='removef$j' value='1'></input>
                    <input  type='submit' value='Remove'></input>
                    </td>
                    </form>
                </tr>
                ";
                       if (isset($_POST["removef$j"])){
                            if($_POST["removef$j"]==1)
                            {
                                $sql="DELETE FROM foe WHERE user_id=$useid && foe_id=$foeid";
                                $conn->query($sql);
                            echo "<script>alert('Your foe is successfully Deleted!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
                            }
                            $_POST["removef$j"]=0;  
                            }
                    
                    }
                    //echo $_GET['block'];
                    $j++;
                        
                }
                }
                
                
//process value
//blcok an unblock
          
                
                
                
                
//end connection
                $conn->close();
                ?>

                </tbody>
            </table>
        </div><!-- /example -->        

    </body>
</html>
