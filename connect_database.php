<?php
$servername = "mysql1.cs.clemson.edu";
    $username = "Metube_2b0d";
    $password = "metube15";
    $dbname = "Metube_yu37";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //else{
      //  echo "connected";
    //}
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

