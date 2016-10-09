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
            h2{
                font-family:Helvetica; 
                color: indigo;
            }
            a{
               text-align: center;
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
                        
<!-- My upload -->             
                <a href="myupload.php" target="_self"><h2>My Upload</h2></a>

<!-- My Favorite List -->
<br>
<!-- <a target="_self" href="myfav.php" style="text-decoration:none"><h2 style="font-family:Helvetica; color: indigo">MY FAVORITE LIST</h2></a>
-->
<a href="myfav.php" target="_self"><h2>My Favorite</h2></a>
<br>
<a href="myplaylist.php" target="_self"><h2>My Play List</h2></a>
<br>
<a href="mychnl.php" target="_self"><h2>My Channel</h2></a>
<br>
<a href="mysub.php" target="_self"><h2>My Subscribe</h2></a>
<br>
<a href="myshare.php" target="_self"><h2>Mediums Shared To Me</h2></a>

    </body>
</html>
