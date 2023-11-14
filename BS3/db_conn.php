<?php
$servername = "localhost";
$database = "record";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, null, "/path/to/mysql.sock");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo "connected successfully!";
mysqli_close($conn);
?>