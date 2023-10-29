<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["user_id"])) {
    require 'connection.php';
    $query = "SELECT * FROM `User` WHERE id = {$_SESSION["user_id"]}";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_array($result);
}

?>
<!DOCTYPE html>
<html lang="en">

<head class="test">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Soldier's Game Store</title>
    <link rel="Website Icon" href="Images/Logo.png" />
    <!-- Link to Stylesheet -->
    <link rel="stylesheet" href="style2.css" />
    <!-- Link to Presets Stylesheet -->
    <link rel="stylesheet" href="style-presets.css" />
    <!-- Link to Box Icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" />
    <script src="script.js"></script>
</head>

<body>

    <header>
        <div class="nav container">

            <div class="logo">
                <img id="logo-img" src="uploads/Logo.png" alt="" />
                <p id="logo-text" style="cursor:default;">Games Galaxy</p>
                <?php
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
            <div class="icons">
                <div class="container-search">
                    <input id="search" type="text" name="text" class="input" required="" placeholder="Type to search...">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <title>Search</title>
                            <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                        </svg>
                    </div>
                </div>
                <label class="container-theme">
                    <input checked="checked" type="checkbox" id="theme">
                    <svg viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="moon">
                        <path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"></path>
                    </svg>
                    <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="sun">
                        <path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"></path>
                    </svg>
                </label>
                <i class="bx bx-cart nav-icons" id="cart-icon"></i>
                <a href="#contact-us" id="contact">Contact Us</a>
                <a class="dash">-</a>
                <?php
                if (isset($user)) {
                    echo '<a href="logout.php" id="contact">Log Out</a>';
                } else {
                    echo '<a href="login.php" id="contact">Login/Signup</a>';
                }
                ?>
            </div>
            <div class="cart">
                <!-- Cart -->
                <h2 class="cart-title">Your Cart</h2>
                <div class="cart-content"></div>
                <!-- Total -->
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>
                <!-- Buy Button -->
                <button type="button" class="btn-buy">Buy Now</button>
                <i class="bx bx-x" id="close-cart"></i>
            </div>
        </div>
    </header>
    <section class="store container">
        <h2 class="section-title">Store Products</h2>
        <div class="store-content">
            <?php
            require 'connection.php';
            $gamesQuery = "SELECT * FROM `Games` order by name asc";
            $gamesResult = mysqli_query($con, $gamesQuery);

            while ($games = mysqli_fetch_array($gamesResult)) {
                $dev = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `Developer` where id = " . $games['developer']));
                $cat = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `Category` where id = " . $games['category']));
                echo '
        <div class="product-box">
        <a class="product-box__inner" href="game-description.php?id=' . $games['id'] . '">
          <div>
            <img src="' . $games['image'] . '" class="product-img" />
          </div>
          <h2 class="product-title">' . $games['name'] . '</h2>
          </a>    
          <p class="game-id">' . $games['id'] . '</p>
          <p class="dev-cat">Developer: <span class="cat-dev">' . $dev['name'] . '</span> </p>
          <p class="dev-cat">Category: <span class="cat-dev">' . $cat['name'] . '</span> </p>
          <span class="price">';
                if ($games['price'] == 0) {
                    echo "Free to Play!";
                } else {
                    echo $games['price'] . '$';
                }
                echo '</span>
          <i class="bx bxs-cart-add add-cart" id="cart-icon"></i>
            </div>
          ';
            }
            ?>
    </section>
</body>
<div id="scrollToTopBtn" class="scroll-to-top-button" onclick="scrollToTop()">&#8679; Scroll to Top</div>
<footer id="contact-us">
    <div>
        <div>
            <i class="bx bx-phone nav-icons footer-icons"></i><span>Phone Number :</span> +961 70585492
        </div>
        <div>
            <i class="bx bx-mail-send nav-icons footer-icons"></i><span>E-mail :</span>
            <a href="mailto:omar.eljundi@hotmail.com">omar.eljundi@hotmail.com</a>
        </div>
        <div>
            <i class="bx bxl-discord nav-icons footer-icons"></i><span>Discord :</span> its_soldier
        </div>
    </div>
</footer>
<script src="script.js"></script>

</html>
<style>
    /* Style for the scroll to top button */
    .scroll-to-top-button {
        display: none;
        /* Initially, hide the button */
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: firebrick;
        /* Button background color */
        color: #fff;
        /* Button text color */
        border: none;
        border-radius: 50%;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
    }
</style>
<script>
    // Function to check the scroll position and show/hide the button
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }

    // Function to scroll back to the top when the button is clicked
    function scrollToTop() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
    }
</script>