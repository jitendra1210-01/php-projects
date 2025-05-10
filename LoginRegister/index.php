<?php
 include "config.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="menu-bar">
    <div class="container">
        <div class="logo">
            <p>Jitt's</p>
        </div>
        <div class="menu-list">
            <ul>
                <?php 
                session_start(); // Ensure session is started
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="Login.php">Login</a></li>
                    <li><a href="Register.php">Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

  <!-- Welcome section -->
  <div class="welcome-section">
    <div class="welcome-box">
      <h2>Welcome, Guest!</h2>
      <p>If you are already registered, please log in.</p>
      <p>If you are not registered yet, please register.</p>
    </div>
  </div>

</body>
</html>
