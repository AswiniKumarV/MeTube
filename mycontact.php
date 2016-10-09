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
                <h2 style="font-family:Helvetica">MY CONTACTS 
                    <!-- Add contacts--><form method="post" action="addcontact.php" class="current">
                    <input  type="submit"  value="Add Contact"></input></h2>
                <input type="hidden" name="addc" value="1">                
                </form>
                <form method="post" action="friendfoe.php" class="current">
                    <input type="submit" value="My Friends and Foes"></input>
                </form>
                <br><br><br>
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
                    <th>Block/Unblock</th>
                    <th>Remove Contacts</th>
                </tr>
                <?php
                $email = $_SESSION["eml"];
                $usenm = $_SESSION["useName"];
                $useid = $_SESSION["userid"];
                //echo $useid;
                $sql = "SELECT user_id, contact_id FROM contact WHERE user_id='$useid'";
                $result = $conn->query($sql);
               
                //$sql = "SELECT user_id, username, email, status,gender FROM User WHERE email='$email'";
                if ($result->num_rows > 0) {
                    // output data of each row

                    $self = $_SERVER["PHP_SELF"];
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $conid = $row["contact_id"];

                        //echo $friendid;
                        $sql = "SELECT user_id, username, email, status,gender FROM User WHERE user_id='$conid'";
                        $coninfo = $conn->query($sql);
                        $info = $coninfo->fetch_assoc();
                        $sqlblock = "SELECT user_id, block_user_id FROM block_user WHERE user_id='$useid' && block_user_id='$conid'";
                        $resultbl = $conn->query($sqlblock);
                        if ($i % 2 == 1) {
                            //contact information
                            echo "
                <tr>
                    <form method='post' action='mycontact.php'>
                    <th scope='row'>$i</th>
                    <td>" . $info['username'] . "</td>
                    <td>" . $info['email'] . "</td>
                    <td>" . $info['status'] . "</td>
                    <td>" . $info['gender'] . "</td>";


                            //user blocking

                            if ($resultbl->num_rows > 0) {
                                echo
                                "<td>      
                    <input  type='hidden'  name='unbl$i' value='1'></input>
                    <input  type='submit'  name='unbl' value='Unblock'></input>
                            </form></td>";
                            } else {
                                echo
                                "<form method='post' action='mycontact.php'>
                                    <td>                                
                    <input  type='hidden'  name='bl$i' value='1'></input>
                    <input  type='submit'  name='bl' value='Block'></input>
                            </form></td>";
                            }


                            //remove contact
                            echo
                            "<form method='post' action='mycontact.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";
                if (isset($_POST["unbl$i"])){
                            if ($_POST["unbl$i"] == 1) {
                                $sql = "DELETE FROM block_user WHERE user_id=$useid && block_user_id=$conid";
                                $conn->query($sql);
                                echo "<script>alert('Your contact is successfully unblocked!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["unbl$i"] = 0;

                            if ($_POST["bl$i"] == 1) {
                                $sql = "INSERT INTO block_user(user_id,block_user_id) VALUES ('$useid', '$conid')";
                                $conn->query($sql);
                                echo "<script>alert('Your contact is successfully blocked!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["bl$i"] = 0;

                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM contact WHERE user_id=$useid && contact_id=$conid";
                                $conn->query($sql);
                                echo "<script>alert('Your contact is successfully Deleted!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["remove$i"] = 0;
                        }
					}
                        if ($i % 2 == 0) {
                                       //contact information
                            echo "
                <tr class='alt'>
                    <form method='post' action='mycontact.php'>
                    <th scope='row'>$i</th>
                    <td>" . $info['username'] . "</td>
                    <td>" . $info['email'] . "</td>
                    <td>" . $info['status'] . "</td>
                    <td>" . $info['gender'] . "</td>";


                            //user blocking

                            if ($resultbl->num_rows > 0) {
                                echo
                                "<td>      
                    <input  type='hidden'  name='unbl$i' value='1'></input>
                    <input  type='submit'  name='unbl' value='Unblock'></input>
                            </form></td>";
                            } else {
                                echo
                                "<form method='post' action='mycontact.php'>
                                    <td>                                
                    <input  type='hidden'  name='bl$i' value='1'></input>
                    <input  type='submit'  name='bl' value='Block'></input>
                            </form></td>";
                            }


                            //remove contact
                            echo
                            "<form method='post' action='mycontact.php'>
                                <td>                               
                    <input  type='hidden' name='remove$i' value='1'></input>
                    <input  type='submit' name='remove' value='Remove'></input></form>
                    </td>
                    
                </tr>";

                if ((isset($_POST["unbl$i"]))){
                            if ($_POST["unbl$i"] == 1) {
                                $sql = "DELETE FROM block_user WHERE user_id=$useid && block_user_id=$conid";
                                $conn->query($sql);
                                echo "<script>alert('Your contact is successfully unblocked!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["unbl$i"] = 0;
						}
						
						if(isset($_POST["bl$i"])){

                            if ($_POST["bl$i"] == 1) {
                                $sql = "INSERT INTO block_user(user_id,block_user_id) VALUES ('$useid', '$conid')";
                                $conn->query($sql);
                                echo "<script>alert('Your contact is successfully blocked!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                            }

                            $_POST["bl$i"] = 0;
						}
						
						if(isset($_POST["remove$i"])){

                            if ($_POST["remove$i"] == 1) {
                                $sql = "DELETE FROM contact WHERE user_id=$useid && contact_id=$conid";
                                $conn->query($sql);
                                //delete it from all the list
                                $sql1 = "DELETE FROM block_user WHERE user_id=$useid && block_user_id=$conid";
                                $conn->query($sql1);
                                $sql2 = "DELETE FROM friend WHERE user_id=$useid && friend_id=$conid";
                                $conn->query($sql2);
                                $sql3 = "DELETE FROM foe WHERE user_id=$useid && foe_id=$conid";
                                $conn->query($sql3);
                                echo "<script>alert('Your contact is successfully Deleted!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
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
