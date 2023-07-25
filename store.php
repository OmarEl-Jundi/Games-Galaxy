<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Soldier's Game Store</title>
    <link rel="Website Icon" href="Images/Logo.png"/>
    <!-- Link to Stylesheet -->
    <link rel="stylesheet" href="style2.css"/>
    <!-- Link to Box Icons -->
    <link
            rel="stylesheet"
            href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
    />
    <script src="script.js"></script>
</head>
<body>
<header>
    <div class="nav container">

        <div class="logo">
            <img id="logo-img" src="uploads/Logo.png" alt=""/>
            <a href="#" class="">Games Galaxy</a>
            <a href="index.php" class="home">Home</a>
        </div>
        <div class="icons">
            <i class="bx bx-search-alt-2 nav-icons" id="search-icon"></i>
            <input type="search" placeholder="Search" id="search"/>
            <p>Dark Mode:</p>
            <i class="bx bx-toggle-left nav-icons" id="dark"></i>
            <i class="bx bx-cart nav-icons" id="cart-icon"></i>
            <a href="#contact-us" id="contact">Contact Us</a>
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
          <div>
            <img src="' . $games['image'] . '" class="product-img" />
          </div>
          <h2 class="product-title">' . $games['name'] . '</h2>
          <p class="dev-cat">Developer: <span class="cat-dev">' . $dev['name'] . '</span> </p>
          <p class="dev-cat">Category: <span class="cat-dev">' . $cat['name'] . '</span> </p>
          <span class="price">';
            if($games['price'] == 0){
                echo "Free to Play!";
            }else{
                echo $games['price'].'$';
            }
            echo '</span>
          <i class="bx bxs-cart-add add-cart" id="cart-icon"></i>
        </div>';
        }
        $gamesResult = mysqli_query($con, $gamesQuery);
        while ($games = mysqli_fetch_array($gamesResult)) {
            echo '
    <div class="product-description">
          <i class="bx bx-x close-desc"></i>
          <p class="desc-title">' . $games['name'] . '</p>
          <iframe
            width="560"
            height="315"
            src="' . $games['trailer'] . '"
          >
          </iframe>
          <p>
            <span> Description: </span> <br />
            ' . $games['description'] . '
          </p>
        </div>';
        }
        ?>
</section>
</body>
<footer id="contact-us">
    <div>
        <div>
            <i class="bx bx-phone nav-icons footer-icons"></i
            ><span>Phone Number :</span> +961 70585492
        </div>
        <div>
            <i class="bx bx-mail-send nav-icons footer-icons"></i
            ><span>E-mail :</span>
            <a href="mailto:omar.eljundi@hotmail.com">omar.eljundi@hotmail.com</a>
        </div>
        <div>
            <i class="bx bxl-discord nav-icons footer-icons"></i
            ><span>Discord :</span> its_soldier
        </div>
    </div>
</footer>
<script src="script.js"></script>
</html>

