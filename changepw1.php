<?php
session_start();
include 'connect_database.php';
$e = $_SESSION["eml"];
$name = $_SESSION["useName"];
$id=$_SESSION["userid"];

echo "<h4 style='font-family:verdana; color:indigo'>";
echo"<form method='post' action='changepw1.php'>"
 . "Please input your new password:<br><input type='password' name='npass'></input><br>";
echo"Please repeat your new password:<br><input type='password' name='rpass'></input>";
echo "<input type='submit'></input></form>";

$len = strlen($_POST["npass"]);
$PassWd=$_POST["npass"];
$PassWr=$_POST["rpass"];
if ($len < 6) {
    echo "<h4 style='font-family:verdana; color:indigo'>Password must be at least 6 characters.</h4>";
    //echo "<br><A href = 'register.php'> <h5>Try again.</h5></a> ";
} else {
    if ($PassWd != $PassWr) {
        echo "<h4 style='font-family:verdana; color:indigo'>Passwords don't match.</h4>";
        //echo "<br><A href = 'register.php'> <h5>Try again.</h5></a> ";
    } else {
        $sql="UPDATE User SET password='$PassWd' WHERE email='$e'";
        $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Password is successfully changed!');location.href='myprofile.php';</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
echo"<br><br><A href = 'myprofile.php'>Return</h4></a> ";
        


        