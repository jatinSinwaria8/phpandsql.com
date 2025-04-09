<div class="task">
  <h1>Question 6</h1><br><br>

  <!-- basic html form with input values of firstname, lastname, fullname and a submit button -->
  <form method="post" action="form_action.php" enctype="multipart/form-data" class="phpform">

    <!-- firstName input -->
    First Name : <input type="text" id="firstname" name="firstname"><br><br>

    <!-- lastName input -->
    Last Name : <input type="text" id="lastname" name="lastname"><br><br>

    <!-- lastName input -->
    Full Name : <input type="text" id="fullname" name="fullname" disabled><br><br>

    <!-- image input -->
    Upload Image : <input type="file" id="picture" name="picture"><br><br>

    Phone Number : <input type="text" name="phone" id="phone"><br><br>

    <!-- Marks Input -->
    Input Marks : <textarea name="textarea" id="textarea" placeholder="Enter marks in format : Subject|Marks" rows="10"
      cols="50"></textarea><br><br>

    <!-- email input -->
    Email Address : <input type="text" name="email" id="email"><br><br>

    <!-- Submit button -->
    <input type="submit" value="Submit"><br>
  </form>

</div>
