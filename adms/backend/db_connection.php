<?php
$host = "localhost";
$username = "root";
$password = ""; // Adjust this if your MySQL has a password
$database = "adbms";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
