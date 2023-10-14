<?php
require 'connection.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Query the database to check if the username already exists
    $query = "SELECT * FROM `User` WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "taken"; // Username is already taken
    } else {
        echo "available"; // Username is available
    }
} else {
    echo "No username provided."; // Debugging output
}

mysqli_close($con);
