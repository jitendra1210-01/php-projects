<?php 
    include "config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name     = trim($_POST["name"]);
        $email    = trim($_POST["email"]);
        $dob      = trim($_POST["dob"]);
        $password = trim($_POST["password"]);
        $cpassword= trim($_POST["cpassword"]);
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp,"uploads/".$image);
            if(preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/",$password)){
            if($password == $cpassword){
              $select_query = "SELECT * from user_table where email = '$email'";
              $select_result = mysqli_query($connection,$select_query);
              $num = mysqli_num_rows($select_result);
              if($num == 1){
                $ShowError = "User Already Exist";
              }else{
                $sql = "INSERT INTO `user_table` (name,email,dob,password,image) VALUES ('$name','$email','$dob','$password','$image')";
                $result = mysqli_query($connection,$sql);
                header("location:login.php");
                
            }
          }
            else{
                $ShowError = "Password and Conform Password Not Matched.";
            }
          }else{
            $ShowError = "Password must be at least 8 characters and include uppercase, lowercase and number.";
          }
        }else{
            $ShowError = "InValid Data";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
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

  <!-- Registration form section -->
  <div class="form-section">
    <div class="form-box">
      <h2>Create an Account</h2>
      <?php if (!empty($ShowError)): ?>
    <div style="color: red; margin: 0 10px; text-align:center"><?php echo $ShowError; ?></div>
<?php endif; ?>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required />
        </div>
        <div class="input-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="input-group">
            <label for="dob">Birth Date</label>
            <input type="date" id="birthdate" name="dob" required />
        </div>
        <div class="input-group">
            <label for="city">Profile image</label>
            <input type="file" id="file" name="image" accept="image/*" />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <div class="input-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" id="confirm-password" name="cpassword" required />
        </div>
        <button type="submit">Register</button>
      </form>
    
      <p class="login-link">Already have an account? <a href="Login.php">Login here</a></p>
    </div>
  </div>

</body>
</html>
