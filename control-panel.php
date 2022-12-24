<?php

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // If the user is not logged in, redirect them to the login page
  header('Location: login.php');
  exit;
}

// Get the username from the session
$username = $_SESSION['username'];

?>

<!-- HTML control panel page -->
<h1>Control Panel</h1>
<p>Welcome, <?php echo $username; ?></p>
