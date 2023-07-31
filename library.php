<?php
require 'connection.php';
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="style2.css" />
</head>


<body>
    <header style="display: flex; justify-content:space-between">
        <div class="nav container">

            <div class="logo">
                <img id="logo-img" src="uploads/Logo.png" alt="" />
                <a href="index.php" class="">Games Galaxy</a>
                <?php
                error_reporting(E_ALL);
                session_start();

                if (isset($_SESSION["user_id"])) {
                    require 'connection.php';
                    $query = "SELECT * FROM `User` WHERE id = {$_SESSION["user_id"]}";
                    $result = mysqli_query($con, $query);
                    $user = mysqli_fetch_array($result);
                }

                if (isset($user)) {
                    if ($user['role'] == 1) {
                        echo '<a href="admin-home.php">Admin Panel</a>';
                        echo '<a href="library.php">Library</a>';
                    } elseif ($user['role'] == 2) {
                        echo '<a href="library.php">Library</a>';
                    }
                }
                ?>
            </div>
        </div>
        <div style="margin-right: 50px; display:flex; align-items:center">
            <?php
            if (isset($user)) {
                echo '<a href="logout.php" id="contact">Log Out</a>';
            } else {
                echo '<a href="login.php" id="contact">Log in</a>';
                echo '<a class="dash">-</a>';
                echo '<a href="signup.php" id="contact">Sign Up</a>';
            }
            ?>
        </div>
    </header>
    <h1>Your Library</h1>
    <div class="library">

        <?php
        $userGamesQuery = "SELECT * FROM `UserLibrary` WHERE user_id = {$_SESSION["user_id"]}";
        $userGames = mysqli_query($con, $userGamesQuery);

        while ($userGamesResult = mysqli_fetch_array($userGames)) {
            $gamesQuery = "SELECT * FROM `Games` WHERE id = " . $userGamesResult['game_id'];
            $gamesResult = mysqli_query($con, $gamesQuery);

            $games = mysqli_fetch_array($gamesResult);
            $dev = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `Developer` where id = " . $games['developer']));
            $cat = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `Category` where id = " . $games['category']));
            echo '
        <div class="product-box">
          <div>
            <img src="' . $games['image'] . '" class="product-img" />
          </div>
          <h2 class="product-title">' . $games['name'] . '</h2>
          <p class="game-id">' . $games['id'] . '</p>
          <p class="dev-cat">Developer: <span class="cat-dev">' . $dev['name'] . '</span> </p>
          <p class="dev-cat">Category: <span class="cat-dev">' . $cat['name'] . '</span> </p>
          <span class="price">';
            if ($games['price'] == 0) {
                echo "Free to Play!";
            } else {
                echo $games['price'] . '$';
            }
            echo '</span>';
            echo '</div>';
        }

        ?>
    </div>
</body>
<style>
    h1 {
        margin-top: 100px;
        text-align: center;
    }

    .product-box {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .library {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 20px;
    }
</style>

</html>