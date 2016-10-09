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
            h4
            {
                font-family: verdana;
                color: indigo;
            }

        </style>
    </head>
    <body>
        <h4>Please input the Email of the foe you want to add.
            <form method="post" action="addfoe.php">
                <input type="text" name="emf" ><br>
                <input type="hidden" name="find" value="1">
                <input type="submit" value="Search">
            </form>
        </h3>

        <?php
        // echo $_POST["em"];
        if (isset($_POST["find"])){
        $flag = $_POST["find"];}
        else{ $flag=0;}
        //echo $flag;
        if (isset($_POST["emf"])){
        $e = $_POST["emf"];}
        else{$e=0;}
        //echo $e;
        if ($flag == 1) {
            //echo $e;
            //$_SESSION["Eml"] = $e;

            If ($e != "" && $e != "none") {
                //Email format check
                //If (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Eml)) {
                //    echo "Email invalid.";
                //} else
                {
                    $sql = "SELECT user_id, username, email,status, gender FROM User WHERE email='$e'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $foeid = $row["user_id"];
                        if ($foeid == $useid) {
                            echo "<h4>You cannot add yourself as a foe.</h4>";
                        } else {
                            $sql1 = "SELECT user_id,foe_id FROM foe WHERE user_id='$useid' && foe_id='$foeid'";
                            $result1 = $conn->query($sql1);

                            if ($result1->num_rows > 0) {
                                echo "<h4>Foe already exists.</h4>";
                            } else {
                                //check if user is in foe list
                                $sql2 = "SELECT user_id,friend_id FROM friend WHERE user_id='$useid' && friend_id='$foeid'";
                                $result2 = $conn->query($sql2);
                                if ($result2->num_rows > 0) {
                                    echo "<h4>Sorry you cannot add this user as your foe. <br>This user is your friend."
                                    . "<br>You have to remove it from your friend list first.</h4>";
                                } else {
                                    echo"
                            <table id='contacts'>
                <tbody>
                    <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Gender</th> 
                    <th>Add Foe</th>
                </tr>";

                                    // output data 

                                    $frnm = $row["username"];
                                    $freml = $row["email"];
                                    $frsta = $row["status"];
                                    $frgd = $row["gender"];
                                    $_SESSION["foe1"] = $foeid;
                                    echo"<tr>
                    <form method='post' action='addfoe1.php'>
                    
                    <td>" . $frnm . "</td>
                    <td>" . $freml . "</td>
                    <td>" . $frsta . "</td>
                    <td>" . $frgd . "</td>
                        <td><input type='submit' value='Add'></h5>
            <input type='hidden' name='add' value='1'></td>
            </form>
                    </tr>
                            </tbody>
            </table>
            
                        ";
                                }
                            }
                        }
                    } else {
                        echo "<h4>User doesn't exist.</h4>";
                    }
                }
            } else {
                echo "<h4>Please input Email</h4>";
            }
            $_POST["find"] = 0;
        }
        ?>
        <br><br><br><A href = 'friendfoe.php'><h4>My Friends and Foes</h4>




</body>
</html>

