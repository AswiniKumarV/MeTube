<?php
session_start();
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
//echo "Connected successfully!<br>";

$email = $_SESSION["eml"];
$usenm = $_SESSION["useName"];
$useid = $_SESSION["userid"];
$foeid=$_SESSION["foe1"];
?>
<html>
    <head>
        <style>
 h3{
                font-family: verdana;
                color:indigo;
            }
        </style>
</head>
<?php
                $sql="INSERT INTO foe(user_id,foe_id) VALUES ('$useid', '$foeid')";
                if ($conn->query($sql) === TRUE) {
                        echo "<h3>Foe added!";
                        echo "<br><A href = 'addfoe.php'> <h5>Return</h3></a> ";
                }
 else {echo "Error!";
  echo "<br><A href = 'addfoe.php'> <h3>Return</h3></a> ";
 }
            
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

