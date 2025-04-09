<?php

/**
 * @const string PhonePattern 
 */
const PhonePattern = "/^\+91[1-9]\d{9}$/";

/**
 * PhoneNumber class for phone number processing
 */
class PhoneNumber
{
  /**
   * @var string $phone_value to contain phone number 
   */
  private $phone_value = "";

  /**
   * @var string $empty_phone_value to contain empty phone number error
   */
  public $empty_phone_value = "";

  /**
   * @var string $wrong_phone_value to contain wrong phone number error
   */
  public $wrong_phone_value = "";

  /**
   * Initlizing phone_value for actual phone number
   *
   * @param string $phone_value
   *
   *  @return void
   */
  public function set_phone_value($phone_value)
  {
    $this->phone_value = $phone_value;
  }

  /**
   * Returns phone value
   *
   * @return string
   */
  public function get_phone_value()
  {
    return $this->phone_value;
  }

  /**
   * Validates phone number
   *
   * @param string $which_phone_field Contains phone number to be validated
   *
   * @return void
   */
  public function phone_validate($which_phone_field)
  {

    if (empty($which_phone_field)) {
      // if phone Number is empty show error
      $this->empty_phone_value = "Phone Number cannot be empty!";
      $this->set_phone_value("");
      $this->wrong_phone_value = "";
    } elseif (!preg_match(PhonePattern, $which_phone_field)) {
      // if Phone Number is wrong show error
      $this->wrong_phone_value = "Phone Number should start with +91 with 10 digits after";
      $this->set_phone_value("");
      $this->empty_phone_value = "";
    } else {
      // correct lastname is refined
      $this->set_phone_value(datarefine($which_phone_field));
      $this->wrong_phone_value = "";
      $this->empty_phone_value = "";
    }
  }
}
