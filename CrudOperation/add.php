<?php
    include "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $name = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        if(isset($_FILES["image"])){
            $image = $_FILES["image"]['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($img_tmp,"upload/".$image);
            
            $sql = "INSERT INTO `users`(`name`, `email`, `mobile`,`image`) VALUES ('$name','$email','$phone','$image')";
            $result = mysqli_query($connection,$sql);
            if($result){
                header("location:index.php");
            }
        }

    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crud</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <!-- Link to style.css -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
<div class="header">
        <button class="back-btn" onclick="history.back()">
            <i class="bi bi-arrow-left"></i>
        </button>
        <h1>Crud Operation</h1>
    </div><div class="container">
    <div class="user-form">
    <h2>Add New Record</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="user-input-group">
            <label for="username">Name</label>
            <input type="text" name="username" required>
        </div>
        <div class="user-input-group">
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="user-input-group">
            <label for="phone">Number</label>
            <input type="text" name="phone" required>
        </div>
        <div class="user-input-group">
            <label for="profile">Profile image</label>
            <input type="file" name="image" accept="image/*">
        </div>
        <button type="submit" class="user-submit-btn">Add Record</button>
    </form>
</div>
