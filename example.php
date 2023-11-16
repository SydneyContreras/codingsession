<!DOCTYPE html>
<html>
<head>
  <title>Your Page Title</title>
</head>
<body>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbase = "recordapp_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbase);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    $sql = "SELECT name FROM recordapp_db.office WHERE id=3;";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    if ($row) {
        echo $row['name'];
    } else {
        echo "No results found";
    }
  $conn->close();
?>

<!-- Your HTML content goes here -->

</body>
</html>
