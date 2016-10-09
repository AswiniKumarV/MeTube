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
<html>
    <head>
        <style>
            h3{
                font-family:verdana;
                color:indigo;
            }

            #vedio
            {
                font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
                width:100%;
                border-collapse:collapse;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <table id="vedio">
            <tr>
                <?php
                if (isset($_GET['searchterms'])) {
                    Echo "<h3><A href = 'search.php'>Go back</h3></a></h2><br><br>";
                    //$search = mysql_real_escape_string(trim($_POST['searchterms'])); This is working in my laptop. But this function is not working in the lab machine.
                    //$search = $_POST['searchterms'];
                    $search = $_GET['searchterms'];
                    $query = "SELECT * FROM media WHERE keywords LIKE'%$search%' or title LIKE'%$search%'";
                    $result = $conn->query($query);


                    $num = $result->num_rows;
                    include "display.php";
                }
                ?>
            </tr>
        </table>
    </body>
</html>

