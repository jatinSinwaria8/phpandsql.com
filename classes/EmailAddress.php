<?php

/* * EmailAddress class for email address processing
 * This class is used to validate the email address using an API
 * It checks if the email address has a valid syntax and if it exists.
 */
class EmailAddress
{

  /**
   * @var string $email_value Gets the email address value 
   */
  private $email_value;

  /**
   * @var string $invalid_syntax_email_value Gets the error message for invalid syntax
   */
  public $invalid_syntax_email_value;

  /**
   * @var string $wrong_email_value Gets the error message for wrong email address
   */
  public $wrong_email_value;

  /**
   * Constructor for the EmailAddress class
   * Initializes the email value and error messages
   */
  public function __construct()
  {
    // initilization of email value 
    $this->email_value = "";

    // initilization of empty email value for errors
    $this->invalid_syntax_email_value = "";

    // initilization of wrong email value for errors
    $this->wrong_email_value = "";

  }

  /**
   * Sets the email value
   * 
   * @param string $email_value The email address to set
   *
   * @return void
   */
  public function set_email_value($email_value)
  {
    // adding email value
    $this->email_value = $email_value;
  }

  /**
   * Returns the email value
   * 
   * @return string The email address
   */
  public function get_email_value()
  {
    return $this->email_value;
  }

  /** 
   * Validates the email address using an API
   * 
   * @param string $which_email_field The email address to validate
   *
   * @return void
   */
  public function email_validate($which_email_field)
  {
    // set email value
    $this->email_value = trim($which_email_field);

    // set API Access Key
    $access_key = 'f250057339c729acef204ce7b92a162c';

    // set email address
    $email_address = $which_email_field;

    // Initialize CURL:
    $ch = curl_init('http://apilayer.net/api/check?access_key=' . $access_key . '&email=' . $email_address . '');

    // Set CURL options:
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);

    // Check for errors:
    if ($json === false) {
      // If there was an error, display it:
      $error = curl_error($ch);
      curl_close($ch);
      echo "<br>cURL Error: $error";
      return;
    }

    // Close the CURL session:
    curl_close($ch);

    // Decode JSON response:
    $validationResult = json_decode($json, true);

    // Check if the email address is valid:
    if (!filter_var($this->email_value, FILTER_VALIDATE_EMAIL)) {

      // if email address is empty show error
      $this->invalid_syntax_email_value = "Wrong Syntax! Correct Way: name@example.com";
      $this->email_value = "";
      $this->wrong_email_value = "";
    } elseif (!$validationResult['mx_found']) {

      // if email address is wrong show error
      $this->wrong_email_value = "Email address not found!";
      $this->email_value = "";
      $this->invalid_syntax_email_value = "";

    } else {

      // correct email address
      $this->wrong_email_value = "";
      $this->invalid_syntax_email_value = "";
    }
  }
}
