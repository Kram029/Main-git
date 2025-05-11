<?php
session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to Home page
header("Location: Home.php");
exit();
?>
