<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="./styles/login.css">
</head>

<body>
  <?php

  /**
   * @var string $err to store any error message.
   */
  $err = "";

  /**
   * @var string $email to store the email address.
   */
  $email = '';

  // include the DbConnect class
  include './classes/DbConnect.php';
  include './classes/SendEmail.php';

  /**
   * @var DbConnect $db to create a new instance of the DbConnect class.
   */
  $db = new DbConnect();

  /**
   * @var SendEmail $sendEmail to create a new instance of the SendEmail class.
   */
  $sendEmail = new SendEmail();

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the email address from the form
    $email = trim($_POST['forgot_email']);

    // Validate the email address
    if ($db->forgot_password($email)) {
      $sendEmail->set_email($email);
      $sendEmail->send_email();
      exit();
    } else {
      // if credentials are invalid, display error message
      $err = "<br><br><p style='color:red;'>Invalid Email</p>";
    }

  }

  ?>

  <!-- login form -->
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="login-form">

    <!-- Email input Field -->
    <label for="forgot_email">Email:</label>
    <input type="email" id="forgot_email" name="forgot_email" required>
    <br><br>

    <!-- Submit button -->
    <input type="submit" value="Forgot Password">
    <?php echo $err; ?>
  </form>
</body>

</html>
