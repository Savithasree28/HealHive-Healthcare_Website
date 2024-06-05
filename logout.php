<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the interface page
header("Location: interface.php");
exit; // Ensure that no further code is executed after the redirect
?>
