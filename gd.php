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
?>

<!doctype html>
<html>
<head>
</head>

<body>

<form action="insertgd.php" method="post">
	<br />
	<input type="submit" value="Create Group">
	Enter the group name:
	<input type="text" name="groupname" placeholder="Group name goes here..." required>
</form> <br /><br />


<form action="joingd.php" method="post">
<input type="submit" value="Join a Group">
<select name="gdid" required>
<option></option>
	<br /><?php 
	$useid = $_SESSION["userid"];
	$query = "SELECT * FROM gdmembers WHERE gd_userid<>'$useid'";
	$result9 = $conn->query($query);
	if ($result9->num_rows>0) {
		while ($row = $result9->fetch_assoc()) {
			$gd_id = $row['gd_id'];
			$gduserid = $row['gd_userid'];
			$query1 = "SELECT gd_name FROM gdteams WHERE gd_id='$gd_id'";
			$friendname = $conn->query($query1);
			$row1 = $friendname->fetch_assoc();
			$gdname = $row1['gd_name'];
			$query5 = "SELECT * FROM gdmembers WHERE gd_id='$gd_id' and gd_userid='$useid'";
			$result5 = $conn->query($query5);
			if ($result5->num_rows>0) {	;//Do nothing.
			} else {
				echo "<option value='$gd_id'> $gdname </option><br />";
			}
		}
	} ?>
</select>
</form> 
Note: If there are no items to select that's because you don't have new groups to join.

<form action="gdcontent.php" method="post">
	<br /><br />
	<input type="submit" name="set" value="See my Group Discussions"> <br /><br />
</form>


</body>

</html>

