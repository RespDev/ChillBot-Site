<?php
// Connect to the MySQL database
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form has been submitted
if (isset($_POST["submit"])) {
  // Get the entered username and password
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if the username and password are correct
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Login successful, redirect to the control panel page
    header("Location: control_panel.php");
  } else {
    // Login failed, display an error message
    echo "Invalid username or password";
  }
}
?>

<!-- HTML for the login form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username">
  <br>
  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  <br>
  <input type="submit" name="submit" value="Login">
</form>
