<?php session_start();
include 'connect_database.php';
$e = $_SESSION["eml"];
$name = $_SESSION["useName"];
$id=$_SESSION["userid"];?>
<html>
    <head>
        <style>
            a{
                color:black;
                text-decoration:none;
            }
        </style>
    </head>
    <body>
        <?php 
        echo "
        <h4 style='font-family:verdana; color:indigo'>
        Please input your former password:
        <form method='post' action='changepw.php'>
        <input type='password' name='opass'></input><br>
        <input type='submit'></input>
        </form></h4>";
        
        //echo $id;
        $sql = "SELECT password FROM User WHERE user_id='$id'";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        if ($result->num_rows > 0) {               
                //echo $row["password"];
                //echo "helloworld";
                //echo "<br>id: " . $row["User_Id"] . " - Name: " . $row["Username"] . " " . $row["Email"] . "<br>";
                if (isset($_POST["opass"])) {
                    if($_POST["opass"]!= $row["password"]){
                    echo "Password not match.";
                } else {
                    echo  "<script>window.location=\"changepw1.php\";</script>";                    
                }
                }
                
        } 
        echo"<A href = 'myprofile.php'><h4 style='font-family:verdana; color:indigo'>Return</h4></a>";

        ?>

        </body>