<?php
// Start a session (if not already started)
session_start();

if (isset($_GET['id'])) {
    // Include the database connection file
    require 'connection.php';

    // Get the product ID from the query parameter
    $productId = $_GET['id'];

    // Fetch the game details from the database
    $query = "SELECT * FROM `Games` WHERE id = $productId";
    $result = mysqli_query($con, $query);

    if ($product = mysqli_fetch_array($result)) {
        // You can access game details using $product array, e.g., $product['name'], $product['trailer'], $product['description'], etc.
    } else {
        // Handle the case where the game is not found
        echo "Game not found";
    }
} else {
    // Handle the case where no game ID is provided
    echo "Game ID not provided";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Game Description</title>
    <link rel="stylesheet" href="style2.css">
    <!-- Add any additional CSS or stylesheets you need -->
</head>

<body>
    <header>
        <!-- Add your header content here -->
    </header>
    <section class="game-description container">
        <h2 class="section-title"><?php echo $product['name']; ?></h2>
        <div class="game-details">
            <iframe width="560" height="315" src="<?php echo $product['trailer']; ?>"></iframe>
            <p><strong>Description:</strong><br><?php echo $product['description']; ?></p>
            <!-- Add any other game details you want to display -->

            <!-- "Go Back" button to return to the previous page -->
            <button onclick="goBack()">Go Back</button>
        </div>
    </section>

    <!-- Add any additional sections or content you need for the page -->

    <script>
        // JavaScript function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>