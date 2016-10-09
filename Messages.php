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

$userid = $_SESSION['userid'];
$usename = $_SESSION['useName'];

echo "<form action='seemessages.php' method='post'>";
echo "<input type='submit' name = 'mediaid' value = 'Check Messages'>";
echo "</form>";

$query = "SELECT * FROM User";
$users = $conn->query($query);
echo "<form action='uploadmessage.php' method='post'>";
echo "Wish to Message:";
echo "<table> 
	  <tr> 
	  <td> Select an User:";
echo "<select name='to_userid' required>";
echo "<option></option>";
while ($row = $users->fetch_assoc()) {
	$user_name = $row['username'];
	$to_userid = $row['user_id'];
	echo "<option value='$to_userid'>$user_name</option>";
}
echo "</select></td>";
echo "<td><textarea name='msg' id='comment' required></textarea> </td>";
echo "</tr> 
	  <tr><td> </td>
	  <td> <input type='submit' name = 'mediaid' value = 'Submit'> </td>
	  <tr>	
		</table>";
echo "</form>";


// $query1 = "SELECT username FROM User WHERE user_id='$friend_id'";
// $friendname = $conn->query($query1);
// $row1 = $friendname->fetch_assoc();
// $friendname = $row1['username'];
//echo "<input type='hidden' name = 'mediaid' value = '$mediaid'>";
//window.location.href='admin/ahm/panel';
