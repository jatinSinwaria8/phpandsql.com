<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="./styles/login.css">
</head>

<body>
  <?php

  // include the EmailAddress and DbConnect classes.
  include_once './classes/EmailAddress.php';
  include_once './classes/DbConnect.php';

  /**
   * @var EmailAddress $emailObj to store and validate email address .
   */
  $emailObj = new EmailAddress();

  /**
   * @var DbConnect $db to connect to the database and register the user.
   */
  $db = new DbConnect();

  /*
   * @var string $err to store error messages.
   */
  $err = '';

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     * @var string $username to store the username.
     */
    $username = trim($_POST['reg_username']);

    /**
     * @var string $password to store the password.
     */
    $password = trim($_POST['reg_password']);

    /**
     * @var string $repassword to store the retyped password.
     */
    $repassword = trim($_POST['re_reg_password']);

    // Check if passwords match.
    if ($password !== $repassword) {
      $err .= "<br>Passwords do not match!<br>";
    } else {

      /**
       * @var string $email to store the email address.
       */
      $email = trim($_POST['reg_email']);

      // Validate the email address.
      $emailObj->set_email_value($email);
      $emailObj->email_validate($email);


      if ($emailObj->get_email_value()) {
        // Check if the email address is already registered else register user. 
        $db->register($username, $password, $email);
      } else {
        // If the email address is invalid, set the error message.
        $err .= "<br>Registration failed!<br>";
      }
    }
  }

  ?>

  <!-- register form -->
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="login-form">

    <!-- Email Input -->
    <label for="reg_email">Email:</label>
    <input type="email" id="reg_email" name="reg_email" required>
    <br>
    <span class="error">
      <?php
      // Display error messages if any.
      if (!empty($emailObj->invalid_syntax_email_value)) {
        echo $emailObj->invalid_syntax_email_value;
      }
      if (!empty($emailObj->wrong_email_value)) {
        echo $emailObj->wrong_email_value;
      }
      ?>
    </span>
    <br>

    <!-- Username Input -->
    <label for="reg_username">Username:</label>
    <input type="text" id="reg_username" name="reg_username" required>
    <br><br>

    <!-- Password Input -->
    <label for="reg_password">Password:</label>
    <input type="password" id="reg_password" name="reg_password" required>
    <br><br>

    <!-- Retype-Password -->
    <label for="re_reg_password">Retype-Password:</label>
    <input type="password" id="re_reg_password" name="re_reg_password" required>
    <br><br>

    <!-- Submit Button -->
    <input type="submit" value="Register">
    <br><br>
    <p style='color:red;'>
      <?php
      // Display error messages if any.
      echo $err;
      ?>
    </p>
  </form>

  <!-- Link to login page -->
  <a href="login.php">Login</a>

</body>

</html>
