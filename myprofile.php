<?php session_start(); ?>
<html>
    <head>
        <style>
            a{
                color:black;
                text-decoration:none;
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

//echo $_SESSION["useName"];
        $e = $_SESSION["eml"];
        $name = $_SESSION["useName"];

//Get user information
        $sql = "SELECT status,gender FROM User WHERE username='$name'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $status = $row["status"];
        $gender = $row["gender"];
// define variable and set them to null
//$nameerr = $emailerr = $gendererr = $websiteerr = "";
//$name = $email = $gender = $status = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameerr = "Name is required.";
            } else {
                $name = test($_POST["name"]);
                // 检查姓名是否包含字母和空白字符
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameerr = "Letters and spaces only.";
                }
            }

            if (empty($_POST["email"])) {
                $emailerr = "Email is required";
            } else {
                $email = test($_POST["email"]);
                // 检查电子邮件地址语法是否有效
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
                    $emailerr = "Email is invalid";
                }
            }

            if (empty($_POST["status"])) {
                $status = "";
            } else {
                $status = test($_POST["status"]);
                $sql = "UPDATE User SET status='$status' WHERE email='$e'";
                $conn->query($sql);
            }
            if (empty($_POST["gender"])) {
                $gendererr = "Gender is required";
            } else {
                $gender = test($_POST["gender"]);
                if ($gender == 'f') {
                    $sql = "UPDATE User SET gender='f' WHERE email='$e'";
                } else {
                    $sql = "UPDATE User SET gender='m' WHERE email='$e'";
                    //$sql = "UPDATE User SET status='$status' WHERE email='$e'";
                }
                $conn->query($sql);
                echo "<script>alert('Your profile is successfully updated!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
            }
        }

        function test($inpt) {
            $inpt = trim($inpt);
            $inpt = stripslashes($inpt);
            $inpt = htmlspecialchars($inpt);
            return $inpt;
        }
        ?>

        <h2 style="color:indigo; font-family:verdana;text-align:center">My Profile</h2>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
            <h3 style="color:indigo; font-family:verdana">
                Name: <?php echo $name; ?>
                <br><br>
                E-mail: <?php echo $e; ?>
                <br><br>
                Password: <a href="changepw.php" style="text-decoration: underline; color:indigo"><h5 style="font-family: verdana; color:indigo">Change my password</h5></a>
                <br>
                Status:<br> 
                <textarea name="status" rows="3" cols="40" placeholder="I'm happy."><?php echo $status; ?></textarea>
                <br><br>
                Gender:
                <input type="radio" name="gender" value ="f" 
<?php if (isset($gender) && $gender == "f") echo "checked='checked'"; ?>>Female
                <input type="radio" name="gender" value="m" 
<?php if (isset($gender) && $gender == "m") echo "checked='checked'"; ?>>Male
                
                <br><br>
                <input style="color:indigo" type="submit" name="submit" value="Submit">
                <input style="color:indigo" type="reset" name="reset" value="Reset">
                </form>
            </h3>


    </body>
</html>