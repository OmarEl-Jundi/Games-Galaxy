<?php
require 'connection.php';
session_start();
if ($_SESSION["user_role"] != 1) {
    header("location: index.php");
}
?>
<html>

<head>
    <title>Your Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="profile">
        <b id="welcome">Welcome Admin: <i>
                <?php
                require 'connection.php';
                if ($_SESSION['user_id']) {
                    $query = "SELECT * FROM `User` WHERE id = {$_SESSION["user_id"]}";
                    $result = mysqli_query($con, $query);
                    $user = mysqli_fetch_array($result);
                    echo $user['username'];
                    echo "<p><span>Full Name: </span>" . $user['fname'] . " " . $user['lname'] . "</p>";
                    echo " <p id='email-p'><span> Your Email: </span>" . $user['email'] . "</p>";
                } else {
                    header("Location:index.php");
                }
                ?>
            </i></b>
        <b id="logout"><a href="logout.php">Log Out</a></b>
    </div>
    <p><a class="admin-links" href="list-games.php">List all the games</a></p>
    <p><a class="admin-links" href="list-condition.php">List games with conditions (id, name, price, developer, category)</a></p>
    <p><a class="admin-links" href="add-game.php">Add a new game to the Database</a></p>
    <p><a class="admin-links" href="add-developer.php">Add a new Developer to the Database</a></p>
    <p><a class="admin-links" href="add-category.php">Add a new Category to the Database</a></p>
    <p><a class="admin-links" href="update-game.php">Update Game Info</a></p>
    <p><a class="admin-links" href="delete-game.php">Delete Game</a></p>
    <p><a class="admin-links" href="index.php">Go back</a></p>
</body>
<style>
    span {
        color: black;
    }

    #email-p {
        margin-bottom: 0px;
    }
</style>
</body>

</html>