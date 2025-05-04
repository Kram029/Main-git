<?php
$host = 'localhost';
$db = 'adbms';
$user = 'root';
$pass = ''; // or your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

