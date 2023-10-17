<?php
require 'connection.php';

if (isset($_GET['username'])) {
    $username = mysqli_real_escape_string($con, $_GET['username']);

    $query = "SELECT id FROM User WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "taken"; // Username already taken
    } else {
        if ($username == '') {
            echo "unavailable"; // Username is available
        } else {
            echo "available"; // Username is available
        }
    }
}

mysqli_close($con);
