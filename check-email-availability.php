<?php
require 'connection.php';

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);

    $query = "SELECT id FROM User WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "taken"; // Email already taken
    } else {
        echo "available"; // Email is available
    }
}

mysqli_close($con);
