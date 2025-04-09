<?php

/**
 * @var Name $firstname stores first name.
 */
$firstname = new Name();

/**
 * @var Name $lastname stores last name.
 */
$lastname = new Name();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // validating firstname and lastname
  $firstname->name_validate($_POST["firstname"]);
  $lastname->name_validate($_POST["lastname"]);
}

?>
<div class="task">
  <h1>Question 1</h1><br><br>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?q=1'); ?>" class="phpform">

    <!-- firstName input -->
    First Name : <input type="text" id="firstname" name="firstname">
    <!-- span showing error for empty value or wrong values -->
    <span> * <?php echo $firstname->wrong_name_value . $firstname->empty_name_value ?></span><br><br>

    <!-- lastName input -->
    Last Name : <input type="text" id="lastname" name="lastname"><span> *
      <!-- span showing error for empty value or wrong values -->
      <?php echo $lastname->wrong_name_value . $lastname->empty_name_value ?></span><br><br>

    <!-- lastName input -->
    Full Name : <input type="text" id="fullname" name="fullname" disabled><br><br>

    <!-- Submit button -->
    <input type="submit" value="Submit"><br>

  </form>

  <!-- div to show output -->
  <div class="formoutput">
    <?php
    if (!empty($firstname->get_name_value()) && !empty($lastname->get_name_value())) {
      echo "<h1>Hello " . $firstname->get_name_value() . " " . $lastname->get_name_value() . "</h1>";
    }
    ?>
  </div>
</div>