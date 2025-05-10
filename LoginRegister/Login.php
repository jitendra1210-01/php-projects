<?php 
  include "config.php";
  // $showError = "";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * from `user_table` where email = '$email'";
    $result = mysqli_query($connection,$sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
      $row = mysqli_fetch_assoc($result);
      if($password == $row['password']){
        session_start();
        $_SESSION['loggedin'] = true;
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      header("Location: home.php");
      exit();
      }else {
        $showError = "Password or user Not Match";
      }
    }else{
      $showError = "User Not Found.";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
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

  <!-- Login form section -->
  <div class="login-section">
    <div class="login-box">
      <h2>Welcome Back!</h2>
      <?php if (!empty($showError)): ?>
    <div style="color: red; margin: 10px 0px; text-align:center"><?php echo $showError; ?></div>
<?php endif; ?>
      <form action="#" method="post">
        <div class="input-group">
          <label for="email">Username(email)</label>
          <input type="email" id="username" name="email" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
      <p class="register-link">Don't have an account? <a href="Register.php">Register here</a></p>
    </div>
  </div>

</body>
</html>
