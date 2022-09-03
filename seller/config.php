<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "Panda@2001";
$dbname = "swaad";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


?>