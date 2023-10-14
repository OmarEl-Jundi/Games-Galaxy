<?php
require 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $username = $_GET['username'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $re_password = $_GET['re_password'];
    $dob = $_GET['dob'];

    $query = "INSERT INTO `User`(`username`, `email`, `password`, `date_of_birth`, `fname`, `lname`, `role`) VALUES ( '$username', '$email', '$password', '$dob', '$fname', '$lname' , '2')";
    if (mysqli_query($con, $query)) {
        echo "Account successfully created";
        header("Location: signup-success.html");
        exit();
    } else {
        echo "Error executing query: " . mysqli_error($con);
    }
}
