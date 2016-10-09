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

if(isset($_SESSION["eml"])){$email = $_SESSION["eml"];}else{$email=0;}
if(isset($_SESSION["useName"])){$usenm = $_SESSION["useName"];}else{$usenm=0;}
if(isset($_SESSION["userid"])){$useid = $_SESSION["userid"];}else{$useid=0;}
if ($useid == 0 || $useid == "") {
    echo "<h2 style='font-family:Helvetica; color:indigo'>";
    echo "Sorry. You have to log in first.</h2>";
} else {

    echo "<br /><br />Hi $usenm, Here are your friends. Select to share the media with them!!   ";
    $query = "SELECT * FROM friend WHERE user_id='$useid'";
    $friends = $conn->query($query);

    $m_id = $_GET['mediaid'];
//echo "$m_id";
    ?>

    <form action="insert_in_share_media.php" method="post">
        <select name="frndid" required>

            <?php
            while ($row = $friends->fetch_assoc()) {
                $friend_id = $row['friend_id'];
                $query1 = "SELECT username FROM User WHERE user_id='$friend_id'";
                $friendname = $conn->query($query1);
                $row1 = $friendname->fetch_assoc();
                $friendname = $row1['username'];
                echo "<option value='$friend_id'> $friendname <br />";
                ?> <?php
            }
            echo "<input type='hidden' name = 'mediaid' value = '$m_id'>"
            . "<input type='submit' value='Submit' name='meid'></select></form>";
        }
        ?>


<!-- <select name="category" required>
<option ></option>
<option value="movie">movie</option>
<option value="nature">nature</option>
<option value="animal">animal</option>
<option value="car">car</option>
</select> -->
