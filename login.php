<?php

session_start();

// check if there is any ongoing sessions
if (isset($_SESSION["login"]) && $_SESSION["login"]) {
  // if yes redirect to main page
  header('Location: ./index.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./styles/login.css">
</head>

<body>

  <?php

  // include the DbConnect class
  include './classes/DbConnect.php';

  /**
   * @var string $username to store the username
   */
  $username = '';

  /**
   * @var string $password to store the password
   */
  $password = '';

  /**
   * @var string $err to store the error message
   */
  $err = "";

  /**
   * @var DbConnect $db to create a new instance of the DbConnect class
   */
  $db = new DbConnect();

  // check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get the username and password from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    /**
     * @var array $login to store the login credentials
     */
    $login = $db->login($username, $password);

    // Validate credentials
    if ($login && ($login['username'] == $username && $login['password'] == $password)) {
      $_SESSION['login'] = true;
      // if credentials are valid, set session variable and redirect to main page
      header('Location: index.php');
      exit();
    } else {
      // if credentials are invalid, display error message
      $err = "<br><br><p style='color:red;'>Invalid username or password</p>";
    }
  }

  ?>

  <!-- login form -->
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="login-form">

    <!-- username field -->
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>

    <!-- password field -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>

    <!-- submit button -->
    <input type="submit" value="Login">
    <?php echo $err; ?>
  </form>

  <!-- Registration Link -->
  <a href="register.php">Register</a>

  <!-- Forgot Password Link -->
  <a href="forgot_password.php">Forgot Password</a>

</body>

</html>
