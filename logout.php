<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: login.php"); // Change to your login page path if different
exit();
?>