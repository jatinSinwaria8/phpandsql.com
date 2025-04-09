<?php

/**
 * @const string Pattern contains the regex pattern for name validation
 */
const Pattern = "/^[a-zA-Z]*$/";

/**
 * Name class for name processing and storage
 */
class Name
{
  /**
   * @var string $name_value contains the actual name 
   */
  private $name_value;

  /**
   * @var string $empty_name_value contains the error message for empty name
   */
  public $empty_name_value;

  /**
   * @var string $wrong_name_value contains the error message for wrong name
   */
  public $wrong_name_value;

  /**
   * Constructor to initialize name_value, empty_name_value and wrong_name_value
   *
   * @return void
   */
  public function __construct()
  {
    // Initilizing name_value for actual name
    $this->name_value = "";
    // Initilizing empty name_value for errors
    $this->empty_name_value = "";
    $this->wrong_name_value = "";
  }

  /**
   * 
   * Set name_value for the name
   * 
   * @param mixed $name_value contains the name value
   * 
   * @return void
   */
  public function set_name_value($name_value)
  {
    $this->name_value = $name_value;
  }

  /**
   * 
   * Returns the name_value for the name
   * 
   * @return string $name_value contains the name value
   */
  public function get_name_value()
  {
    return $this->name_value;
  }

  /**
   * 
   * Validate the name value
   * 
   * @param string $which_name_field contains the name value
   * 
   * @return void
   */
  public function name_validate($which_name_field)
  {
    // if firstname is empty show error
    if (empty($which_name_field)) {
      $this->empty_name_value = "Name field cannot be empty!";
      $this->name_value = "";
      $this->wrong_name_value = "";
    } elseif (!preg_match(Pattern, $which_name_field)) {
      // if firstname is wrong show error
      $this->wrong_name_value = "Name inputs can only contain alphabets!";
      $this->name_value = "";
      $this->empty_name_value = "";
    } else {
      // correct firstname is refined
      $this->name_value = datarefine($which_name_field);
      $this->wrong_name_value = "";
      $this->empty_name_value = "";
    }
  }
}