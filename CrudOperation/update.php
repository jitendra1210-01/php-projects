<?php
include "config.php";
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $image = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            
            // Upload the file to the "upload" directory
            if (move_uploaded_file($img_tmp, "upload/" . $image)) {
                $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `mobile`='$phone', `image`='$image' WHERE id = '$id'";
            } else {
                echo "Error uploading the image.";
                exit;
            }
        } else {
            // No image was uploaded, so don't change the image in the database
            $sql = "UPDATE `users` SET `name`='$name', `email`='$email', `mobile`='$phone' WHERE id = '$id'";
        }

        // Execute the SQL query to update the user data
        if (mysqli_query($connection, $sql)) {
            header("location:index.php");
        } else {
            echo "Error updating record: " . mysqli_error($connection);
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
    </div>
    <div class="container">
        <div class="user-form">
            <h2>User Details</h2>
            <?php
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="user-input-group">
                        <label for="username">Name</label>
                        <input type="text" name="username" value="<?php echo $row['name'] ?>" required>
                    </div>
                    <div class="user-input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $row['email'] ?>" required>
                    </div>
                    <div class="user-input-group">
                        <label for="phone">Number</label>
                        <input type="text" name="phone" value="<?php echo $row['mobile'] ?>" required>
                    </div>
                    <div class="user-input-group">
                        <label>Current Image</label><br>
                        <img src="upload/<?php echo $row['image']; ?>" width="50" height="50" alt="Profile"><br>
                        <label for="image">Profile image</label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="user-submit-btn">Save Changes</button>
                </form>
                <a href="index.php" class="user-cancel-btn">Cancel</a>
            <?php }}
            ?>
        </div>
    </div>
</body>

</html>
