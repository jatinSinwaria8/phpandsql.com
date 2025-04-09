<?php

/**
 * Picture class for handling picture uploads
 */
class Picture
{
  /**
   * @var string $picture_name Name of the uploaded picture 
   */
  public $picture_name;

  /**
   * @var string $picture_tempname Temporary name of the uploaded picture
   */
  public $picture_tempname;

  /**
   * @var string $picture_path Path where the picture will be saved
   */
  public $picture_path;

  /**
   * Constructor to initialize picture properties
   *
   * @return void 
   */
  public function __construct()
  {
    // initilization of picture name, temp location and file path
    $this->picture_name = "";
    $this->picture_tempname = "";
    $this->picture_path = "";
  }

  /**
   * Set the picture name and temporary name from the uploaded file
   *
   * @return void 
   */
  public function set_picture_path()
  {
    // adding picture path
    $this->picture_path = UploadDir . "/" . basename($this->picture_name);
  }

  /**
   * Move the uploaded picture to the specified directory
   * 
   * @return void
   */
  public function move_picture()
  {
    // moving uploaded picture to upload directory
    move_uploaded_file($this->picture_tempname, $this->picture_path);

  }

}
