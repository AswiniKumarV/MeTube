<?php session_start();?>
<html>
<head>
<style>
h5{
    font-style: verdana;
}
</style>
</head>
<body>
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
    //echo "Connected successfully!<br>";
    
    ?>
<!-- Login -->

<h5 style="font-family:verdana">
<br>
<form action="login and register.php" method="post">
<input type="hidden" name="login" value="1">
Email: <br><input type="text" name="eml"><br/><br/>
Password: <br><input type="password" name="passw"><br/></br>
<input type="submit" value="LOGIN"><br>
<h5>
</form>
<br>
<h4 style="font-family:verdana">New here?
<form action="register.php" method="post">
<button type="submit"  name="register" value="0">REGISTER</button>
</form></h4>



<?php
 if (isset($_POST["login"]))
 {
    $_POST["login"] = 0;
    $email = $_POST["eml"];
    
    $Pass = $_POST["passw"];
    
    //Get user data from the database
    
    If (($email != "none") && ($Pass != "none") && ($email != "") && ($Pass != "")) {
        
        $sql = "SELECT user_id, username, password, email FROM User WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $useName= $row["username"];
               // echo $row["username"];
                
                $_SESSION["userid"]=$row["user_id"];
                //echo $_SESSION["userid"];
                $_SESSION["useName"]=$useName ;
                
                $_SESSION["eml"]=$row["email"];
                
                //echo $_SESSION["eml"];
                //echo "<br>id: " . $row["User_Id"] . " - Name: " . $row["Username"] . " " . $row["Email"] . "<br>";
                if ($Pass == $row["password"]) {
					header('Location:loginbutton.php');
                    //echo "<h5><br><A target='_top' href='loginindex.php'>Login</a></h5>";
                } else {
                    echo"Password is not correct!<br> Please try again.";
                    echo"<br><A href = 'login and register.php'> <h5>Return</h5></a> ";
                }
            }
        } else {
            echo "<h5>User doesn't exist.";
            echo "<br><A href = 'login and register.php'> <h5>Return</h5></a></h5> ";
        }
    } else {
        echo "<h5>One or more blank is missing.<br> Please try again</h5>";
        echo "<br><A href = 'login and register.php'> <h5>Return</h5></a> ";
    }
  }
    $conn->close();
    ?>
</body>
</html>

