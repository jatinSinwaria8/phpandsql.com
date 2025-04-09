<?php
session_start();
// to log out the user, we need to clear the session data
session_unset();
// and destroy the session
session_destroy();
// redirect to the login page
header('Location: login.php');
exit();
?>
