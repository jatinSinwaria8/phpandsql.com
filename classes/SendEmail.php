<?php

// Autoload the PHPMailer classes into the global namespace
require __DIR__ . "/../vendor/autoload.php";

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * SendEmail class for sending email to user.
 */
class SendEmail
{
  /**
   * @var string $email The email address to send the email to. 
   */
  private $email;

  /**
   * @var PHPMailer $mail The PHPMailer instance used to send the email.
   */
  private $mail;

  /**
   * Constructor for the SendEmail class.
   * Initializes the email address and PHPMailer instance.
   *
   * @return void
   */
  public function __construct()
  {
    // Initialize the email address and PHPMailer instance
    $this->email = "";
    $this->mail = new PHPMailer(true);
  }

  /**
   * Sets the email address to send the email to.
   *
   * @param string $email The email address to send the email to.
   * 
   * @return void
   */
  public function set_email($email)
  {
    $this->email = $email;
  }

  /**
   * Gets the email address to send the email to, then send email to user.
   *
   * @return void
   */
  public function send_email()
  {
    try {
      //Server settings
      $this->mail->CharSet = 'UTF-8';//Set email encoding
      $this->mail->isSMTP(); // Set mailer to use SMTP
      $this->mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
      $this->mail->SMTPAuth = true; // Enable SMTP authentication
      $this->mail->Username = 'exampleetc812@gmail.com'; // SMTP username
      $this->mail->Password = 'fqegntxjbrqjwrsh'; // SMTP password
      $this->mail->isSMTP();//Send using SMTP
      $this->mail->Host = 'smtp.gmail.com';//Set the SMTP server to send through
      $this->mail->SMTPAuth = true;//Enable SMTP authentication
      $this->mail->Username = 'exampleetc812@gmail.com';//SMTP username
      $this->mail->Password = 'fqegntxjbrqjwrsh';//SMTP password
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//Enable implicit TLS encryption
      $this->mail->Port = 587;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $this->mail->setFrom('exampleetc812@gmail.com', 'Example-Etc');
      $this->mail->addAddress("$this->email");//Add a recipient
      $this->mail->addReplyTo('exampleetc812@gmail.com', 'Example-Etc');

      //Content
      $this->mail->isHTML(true); // Set email format to HTML
      $this->mail->Subject = 'Reset your password!';

      // Set the email body content and sends email which redirects to reset password page
      $this->mail->Body = "<h1>Reset your password.</h1> <br> <a href = 'www.phpandsql.com/reset_password.php?email=$this->email'>Click Here to reset password</a>";
      $this->mail->AltBody = 'Reset your password.';

      // Send the email
      $this->mail->send();

      // Redirect to login page after sending email
      header("Location: login.php");
      exit();
    } catch (Exception $e) {
      // Handle error if email could not be sent
      echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
    }
  }
}
