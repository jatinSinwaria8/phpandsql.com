<?php

/**
 * DbConnect class for database connection and user management
 */
class DbConnect
{
  /**
   * @var mysqli $con Database connection 
   */
  private $con;

  /**
   * @var string $db Database name
   */
  private $db = "phpsql";

  /**
   * Constructor to establish database connection and create database if it doesn't exist
   */
  public function __construct()
  {
    // Create a new mysqli connection
    $this->con = mysqli_connect("localhost", "jatinSinwaria", "Jatin123!@#");

    if (!$this->con) {
      // Connection failed
      die("Connection failed: " . mysqli_connect_error());
    }

    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $this->db";
    $result = $this->con->query($sql);

    // Check if database creation was successful
    if (!$result) {
      die("Database creation failed: " . mysqli_error($this->con));
    }

    // Select the database
    $this->con->select_db($this->db);

  }

  /**
   * Method to register a new user.
   * 
   * @param string $username gets username.
   * @param string $password gets password.
   * @param string $email gets email.
   * 
   * @return void
   */
  public function register($username, $password, $email)
  {
    // Check if the table exists, if not create it
    $sql = "CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL,
      email VARCHAR(100) NOT NULL UNIQUE
    )";

    // Execute the query
    $this->con->query($sql);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $this->con->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");

    // Check if the statement was prepared successfully
    $stmt->bind_param("sss", $username, $password, $email);

    // Execute the statement
    if ($stmt->execute()) {
      echo "<br>Registration successful!";
    } else {
      echo "<br>Error: " . $stmt->error;
    }
  }

  /**
   * Method to login a user.
   * 
   * @param string $username gets username.
   * @param string $password gets password.
   * 
   * @return array|null
   */
  public function login($username, $password)
  {
    // Check if the Entries exists
    $stmt = $this->con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
      // Fetch the user data
      $row = $result->fetch_assoc();

      // Store user data in session
      return $row;
    } else {

      // No user found with the provided credentials
      return NULL;
    }
  }

  /**
   * Method to check if the email exists for password reset.
   * 
   * @param string $email gets email.
   * 
   * @return bool
   */
  public function forgot_password($email)
  {
    // Check if the Email exists
    $stmt = $this->con->prepare("SELECT email FROM users WHERE email = ?");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * Method to reset the password.
   * 
   * @param string $email gets email.
   * @param string $new_password gets new password.
   * 
   * @return void
   */
  public function reset_password($email, $new_password)
  {
    // Update the password for the user
    $stmt = $this->con->prepare("UPDATE users SET password = ? WHERE email = ?");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("ss", $new_password, $email);

    // Execute the statement
    if ($stmt->execute()) {
      // Password reset successful
      echo "<br>Password reset successful!";
    } else {
      // Password reset failed
      echo "<br>Error: " . $stmt->error;
    }
  }

  /**
   * Method to close the database connection.
   * 
   * @return void
   */
  public function __destruct()
  {
    $this->con->close();
  }
}
