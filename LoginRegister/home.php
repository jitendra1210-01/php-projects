<?php 
  include "config.php";
  session_start();
  if (!isset($_SESSION['loggedin'])) {
    header("location:login.php");
  }
  
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

  <!-- Menu bar -->
  <div class="menu-bar">
    <div class="container">
        <div class="logo">
            <p>Jitt's</p>
        </div>
        <div class="menu-list">
            <ul>
                <?php 
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
 <!-- Profile Section -->
  <?php 
   $email = $_SESSION['email'];
   $sql = "SELECT * FROM `user_table` WHERE email = '$email'";
   $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $date = $row['dob'];
    $formatdate = date("F d, Y",strtotime($date));
  ?>
  <div class="container">

      <div class="profile-section">
        
        <div class="profile-card">
            
            
              <img src="uploads/<?php echo $row['image'] ?>" alt="Profile Picture" class="profile-img" />
              <h3 class="profile-name"><?php echo $row['name'] ?></h3>
              <p class="profile-email"><?php echo $row['email'] ?></p>
              <p class="profile-dob">Date of Birth:<?php echo $formatdate ?></p>
            </div>
        </div>
    </div>

</body>
</html>
