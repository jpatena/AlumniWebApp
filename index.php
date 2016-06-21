<?php
    // The main login page

    // If user already logged in, then redirect to view all events page
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: ./allevents.php');
        exit(); // Ignores rest of code below when executed
    }
?>

<!-- The login form -->
<h2>Admin Login Page</h2>
<form action="login.php" method="post">
Username: <input type="text" name="username" size="36" /> <br>
Password: <input type="password" name="password" size="36" /> <br>
          <input type="submit"   value = "Submit" />
</form>