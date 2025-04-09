<?php

/**
 * Marks class for marks storage
 */
class Marks
{
  /**
   * @var string $string_marks Stores marks as a string
   */
  private $string_marks;

  /**
   * @var array $marks_arr Stores marks as an array
   */
  private $marks_arr;

  /**
   * Constructor to initialize string marks
   *
   * @return void
   */
  public function __construct()
  {
    $this->string_marks = "";
  }

  /** 
   * Function to set string marks
   *
   * @param string $string_marks Marks as a string
   * 
   * @return void
   */
  public function set_string_marks($string_marks)
  {
    $this->string_marks = $string_marks;
  }

  /**
   * Function to get string marks
   *
   * @return string
   */
  public function get_string_marks()
  {
    return $this->string_marks;
  }

  /**
   * Function to set marks array
   *
   * @return void
   */
  public function set_marks_arr()
  {
    // Split the string marks into an array
    $marks = explode("\n", $this->string_marks);
    $index = 0;

    // Initialize the marks array
    foreach ($marks as $str) {
      $temp = explode("|", $str);
      $this->marks_arr[$index][0] = $temp[0];
      $this->marks_arr[$index][1] = (int) $temp[1];
      $index++;
    }
  }

  /**
   * Function to return marks array
   *
   * @return array
   */
  public function get_marks_arr()
  {
    return $this->marks_arr;
  }

}
