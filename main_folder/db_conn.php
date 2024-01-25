<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<?php
  $host = 'localhost';
  $username = 'root';
  $password = 'root';
  $database = 'recordsapp_db';
  
  $conn = new mysqli($host, $username, $password, $database);
  

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "connected.";
?>