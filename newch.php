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
            
            //$mediaid = $_GET["id"];
            echo "<h4>Please input the name of your new channel:"
            . "<form method='post' action='newch1.php' target='_self'>"
            . "<input type='text' name='chname'></input>"
            . "<input type='submit'></input>"
            . "</form></h4>";
            
            
            
            }
            else{
            echo"<h3 style='font-family: verdana; color:indigo; text-align: center'>
                Sorry. You have to log in first.</h3>";
            }
            ?>
            

    </body>




