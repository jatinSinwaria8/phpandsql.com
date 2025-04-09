<?php

// start of session
session_start();

// check if user is logged in session or not
if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {

  //  redirect to login.php
  header('Location: login.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php Basics</title>

  <!-- include jquery scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./src/index.js"></script>

  <!-- link styles -->
  <link rel="stylesheet" href="./styles/styles.css">

</head>

<body>
  <!-- navigation bar to move arround pages -->
  <header>
    <div class="container">
      <nav>
        <ul>
          <!-- All Navigation Links -->
          <li><a href="./index.php?q=1">Question 1</a></li>
          <li><a href="./index.php?q=2">Question 2</a></li>
          <li><a href="./index.php?q=3">Question 3</a></li>
          <li><a href="./index.php?q=4">Question 4</a></li>
          <li><a href="./index.php?q=5">Question 5</a></li>
          <li><a href="./index.php?q=6">Question 6</a></li>
          <li><a href="./logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <!-- main section -->
    <section class="all-tasks">
      <div class="container">
        <div class="all-tasks-wrapper">

          <?php

          // autoloader function to include classes 
          spl_autoload_register(function ($class) {
            include "./classes/" . $class . ".php";
          });

          /**
           * Refine data coming from form input
           * 
           * @param mixed $data
           * 
           * @return string
           */
          function datarefine($data)
          {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          if (!isset($_GET['q'])) {
            $_GET['q'] = 1;
          }

          // different cases to include different tasks
          switch ($_GET['q']) {

            case 1:
              include "./tasks/task1.php";
              break;

            case 2:
              include "./tasks/task2.php";
              break;

            case 3:
              include "./tasks/task3.php";
              break;

            case 4:
              include "./tasks/task4.php";
              break;

            case 5:
              include "./tasks/task5.php";
              break;

            case 6:
              include "./tasks/task6.php";
              break;

            default:
              include "./tasks/task1.php";
              break;
          }
          ?>
        </div>
      </div>
    </section>
  </main>

</body>

</html>
