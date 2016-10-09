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

$query5 = "SELECT * FROM Message WHERE To_UserID LIKE'$userid' ORDER BY  time DESC"; // and msg_read<>'0'";

	$result5 = $conn->query($query5);
	if($result5->num_rows>0){
		while ($row5 = $result5->fetch_assoc()) {
			$fromid = $row5['From_UserID'];
	
			$query6 = "SELECT username FROM User WHERE user_id LIKE'$fromid'";
			$result6 = $conn->query($query6);
			$row6 = $result6->fetch_assoc();
			$fromuser = $row6['username'];
			$message = $row5['Message'];
			$time = $row5['time'];
	
			echo "Time: $time<br/>";
			echo "<b>From:</b> $fromuser:<br />";
			echo "Message: $message<br /><br />";
		}
		echo "<a href='Messages.php'> Go back </a>";
		$sql="UPDATE Message SET msg_read='0' WHERE To_UserID='$userid'";
		$conn->query($sql);
	}else{
		echo "<script>
			alert('There are no unread Messages!!');
			window.location.href='Messages.php';
			</script>";
	}

	
