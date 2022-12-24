<?php

// Start a session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
  // If the user is already logged in, redirect them to the control panel page
  header('Location: control-panel.php');
  exit;
}

// Check if the user has submitted the login form
if (isset($_POST['username']) && isset($_POST['password'])) {
  // Get the username and password from the form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database
  $db = new PDO('mysql:host=localhost;dbname=database_name', 'username', 'password');

  // Prepare a SQL statement to select the user with the given username and password
  $stmt = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
  $stmt->execute(array(
    ':username' => $username,
    ':password' => $password
  ));

  // Fetch the user data
  $user = $stmt->fetch();

  // Check if a user was found
  if ($user) {
    // If a user was found, log them in by storing their username in the session
    $_SESSION['username'] = $username;

    // Redirect the user to the control panel page
    header('Location: control-panel.php');
    exit;
  } else {
    // If no user was found, display an error message
    $error = 'Invalid username or password';
  }
}

?>

<!-- HTML login form -->
<form method="post">
  <label for="username">Username:</label><br>
  <input type="text" name="username" id="username"><br>
  <label for="password">Password:</label><br>
  <input type="password" name="password" id="password"><br><br>
  <input type="submit" value="Log In">
</form>

<?php if (isset($error)) { echo $error; } ?>
