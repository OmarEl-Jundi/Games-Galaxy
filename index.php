<?php

session_start();

if (isset($_SESSION["user_id"])) {
    require 'connection.php';
    $query = "SELECT * FROM `User` WHERE id = {$_SESSION["user_id"]}";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_array($result);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="Website Icon" href="Images/Logo.png"/>
    <link rel="stylesheet" href="style.css">
    <title> Welcome!</title>
</head>
<body>
<div id="profile">
    <?php if (isset($user)): ?>
        <h1>Welcome <?= $user["username"] ?>!</h1>
        <p>You're logged in</p>
        <b id="logout"><a href="logout.php">Log Out</a></b>
        <?php if ($user['role'] == 1) {
            echo '<b><a href="admin-home.php">Go to Admin Panel</a> OR </b>';
        } ?>

    <?php else: ?>
        <h1>Welcome To Games Galaxy!</h1>
        <p><a href="login.php"> Login</a><p><b> OR </b></p><a href="signup.php">Sign Up</a></p>
    <?php endif; ?>
    <b><a href="store.php">Browse the Store</a></b>
</div>
</body>
<style>
    #profile{
        background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(200,0,0,1));
    }
</style>
</html>