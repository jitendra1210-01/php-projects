<?php
include "config.php";
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT image from `users` where id = $id";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];

        $delete_sql = "DELETE  FROM `users` where id = '$id'";
        $d_result = mysqli_query($connection, $delete_sql);
        if ($d_result) {
            $image_path = "upload" . $immage;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            header("location:index.php");
        }
    }
}
