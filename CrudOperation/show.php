<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crud</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
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
        <?php
        $sql = "SELECT * FROM users limit 5";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
        ?>
           
            <div class="table-content">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            $i = 1; ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><img src="upload/<?php echo $row['image']; ?>" width="70" height="70" alt="Profile"></td>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["mobile"] ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id']?>" class="action-btn details-btn">Details</a>
                                    <a href="delete.php?id=<?php echo $row['id']?>" class="action-btn delete-btn">Delete</a>
                                </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
            <div class="button-content">
                
                <a href="index.php" class="add-button"><i class="bi bi-arrow-left"></i>Back</a>

            </div>

    </div>
</body>
</html>
