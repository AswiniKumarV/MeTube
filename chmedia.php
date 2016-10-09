<?php
session_start();
include 'connect_database.php';
?>
<html>
    <head>
        <style>
            #vedio
            {
                font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
                width:100%;
                border-collapse:collapse;
                text-align:center;
            }

            h2{ 
                font-family: verdana; 
                color:indigo; 
                text-align:center;
            }

        </style>

        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>     
        <div>  
            <table id="vedio">
                <tbody>
                    <tr>
                <h2 style="font-family:Helvetica; color: indigo; text-align: center" >
                    <!-- Add contacts-->
               <a href="channel.php" target="_self"><h4 style="text-align: left">My Page</h4></a>  
                    <?php
            if (isset($_GET["id"])) {
                $chid = $_GET["id"];
                //Get channel name
                $sqlch = "SELECT title FROM channel WHERE channel_id=$chid";
                $resultch = $conn->query($sqlch); 
                $rowch = $resultch->fetch_assoc();
                echo "<h2>".$rowch['title']."</h2>";
                
                $sql = "SELECT * FROM media WHERE channel_id=$chid";
                $result = $conn->query($sql); 
                $num=$result->num_rows;
                include 'display.php';
            }else{
                echo "Error!";
            }
            
                ?>
                
  
               </tr>
        </table>
           
    </body>
</html>


                <?php $conn->close();
                ?>
