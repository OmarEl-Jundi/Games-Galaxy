<?php
require 'connection.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "SELECT COUNT(*) FROM `User` WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $count = mysqli_fetch_row($result)[0];
        if ($count == 0) {
            echo "available";
        } else {
            echo "taken";
        }
    } else {
        echo "error";
    }
} else {
    echo "Invalid request";
}

mysqli_close($con);
