<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="./styles/login.css">
</head>

<body>

  <?php

  /**
   * @var string $err TO store error messages.
   */
  $err = "";

  /**
   * @var string $email TO store email address.
   */
  $email = $_GET['email'];

  // include the DbConnect class
  include './classes/DbConnect.php';

  /**
   * @var DbConnect $db TO connect to the database.
   */
  $db = new DbConnect();

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    /**
     * @var string $password TO store the new password.
     */
    $password = trim($_POST['forgot_password']);

    // update the password in the database
    $db->reset_password($email, $password);

    // If the password is reset successfully, redirect to login page
    header('Location: login.php');
    exit();
  }

  ?>

  <!-- login form -->
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="login-form">

    <!-- Password field -->
    <label for="forgot_password">Enter New Password:</label>
    <input type="password" id="forgot_password" name="forgot_password" required>
    <br><br>

    <!-- Confirm Password field -->
    <input type="submit" value="Reset Password">
    <?php echo $err; ?>
  </form>

</body>

</html>
