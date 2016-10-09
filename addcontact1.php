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
$conid=$_SESSION["contact1"];
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
                        
                $sql="INSERT INTO contact(user_id,contact_id) VALUES ('$useid', '$conid')";
                if ($conn->query($sql) === TRUE) {
                        echo "<h3>Contact added!</h3>";
                        
                }
                else {echo "Error!";}
  echo "<br><A href = 'addcontact.php'> <h3>Return</h3></a> ";
 
            

