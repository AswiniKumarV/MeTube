<?php
session_start();
include 'connect_database.php';
if (isset($_SESSION["eml"])){$email = $_SESSION["eml"];}
if (isset($_SESSION["useName"])){$usenm = $_SESSION["useName"];}
if(isset($_SESSION["userid"])){$useid = $_SESSION["userid"];}
?>
<html>
    <head>
        <style>
            h2{
                font-family:verdana;
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
        <h1 style="font-family: verdana; color:indigo; text-align: center">
        </h1>
        <form method="post" action="search.php" target="_self">
        <input type="submit"  value="SEARCH" ></input>
        </form>
        <h2>      
       <table id="vedio">
            <tr>
                <?php
                //select movies from database
                
                $sql = "SELECT * FROM media";
                //echo $sql;
                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $num=$result->num_rows;
                include 'display.php';
                ?>
            </tr>
        </table>
    </body>
</html>



