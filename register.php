
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


if (!$_POST["register"]):
    ?>
    <html>
        <head>
            <style>
                h4 {
                    font-family: verdana;
                    color:black;
                }

                h5 {
                    font-family: verdana;
                    color:black;
                }
                h3 {
                    font-family: verdana;
                    color:black;
                }
                a{
                    color:black;
                    text-decoration:none;
                }
            </style>
        </head>
        <body>
            <h4>Please Register!</h4>
            <form action="register.php" method="post">
                <input type="hidden" name="register" value="1">
                <h5>
                    Username:<br><input type="text" name="username"/><br>
                    Email:<br><input type="email" name="eml"/><br>
                    Password:<br><input type="password" name="password"/><br>
                    Repeat Password:<br><input type="password" name="passwordr"/><br>
                    Password has to be at least 6 characters.<br>
                    <input type="submit" value="REGISTER"><br>
                    <button type="submit" formaction="login and register.php">BACK</button>
                </h5>
            </form>

            <?php
        else:
            //username unique
            $_POST["register"] = 0;
            $Eml = $_POST["eml"];
            $UserName = $_POST["username"];
            $PassWd = $_POST["password"];
            $PassWr = $_POST["passwordr"];
            $len = strlen($PassWd);
            If ($UserName && $PassWd  && $Eml && $PassWr) {
                //Email format check
                If (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Eml)) {
                    echo "<h5>Email invalid.</h5>";
                    echo "<br><A href = 'register.php'> <h5>Try again.</h5></a> ";
                } else {
                    //password check
                    If ($PassWd != $PassWr) {
                        echo "<h5>Passwords don't match.</h5>";
                        echo "<br><A href = 'register.php'> <h5>Try again.</h5></a> ";
                    } else {
                        //password length check
                        if ($len < 6) {
                            echo "<h5>Password must be at least 6 characters.</h5>";
                            echo "<br><A href = 'register.php'> <h5>Try again.</h5></a> ";
                        } else {
                            //new user email check
                            $sql = "SELECT user_id, username, password, email FROM User WHERE email='$Eml'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo "<h5>This Email has already registered.<br>Please login or try another one.";
                                echo "<br><A href='login and register.php'>Return.</a></h5>";
                            } else {

                                $sql = "INSERT INTO User (username, password, email) VALUES ('$UserName', '$PassWd', '$Eml')";


                                if ($conn->query($sql) === TRUE) {
                                    echo "<h5>Register succeeded!</h5>";
                                    echo "<h5><br><A href='login and register.php'>Return to login.</a></h5>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                            $conn->close();
                        }
                    }
                }
            } else {
                echo "<h5>One or more blank is missing.<br> Please try again</h5>";
                echo "<br><A href = 'register.php'> <h5>Return</h5></a> ";
            }
            ?>

        </body>
    </html>
<?php
endif;
?>



