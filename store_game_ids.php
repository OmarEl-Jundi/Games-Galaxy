<?php
session_start();

// Check if the gameIds are present in the query parameters
if (isset($_GET['gameIds'])) {
    // Retrieve the gameIds from the query parameters and convert them to an array
    $gameIds = explode(',', $_GET['gameIds']);

    // Store the game IDs in the PHP session
    $_SESSION['game_ids'] = $gameIds;

    require 'connection.php';

    // Loop through each game ID and insert it into the UserLibrary table
    foreach ($gameIds as $gameId) {
        // Ensure the gameId is an integer (to prevent SQL injection)
        $gameId = intval($gameId);

        // Prepare and execute the INSERT query
        $query = "INSERT INTO `UserLibrary` (`user_id`, `game_id`, `purchase_date_time`) VALUES ({$_SESSION['user_id']}, $gameId, NOW())";
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Respond with a success message
            echo '<p>Game Added successfully</p>';
        } else {
            // Respond with an error message if the query fails
            echo '<p>Failed Add the game </p>';
        }
    }
} else {
    // Respond with an error message
    echo '<p>No gameId received</p>';
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <a href="index.php">Go Back to The Store</a> <br> <br>
        <a href="library.php">Check your library</a>
    </body>
    <style>
        *{
            color: firebrick;
            font-weight: 600;
            font-size: larger;
        }
        p{
            -webkit-text-stroke-width: 0.1px;
            -webkit-text-stroke-color: black;
            background-color: black;
            width: fit-content;
        }
        a{
            color: cyan;
            -webkit-text-stroke-width: 0.1px;
            -webkit-text-stroke-color: black;
            background-color: black;
        }
    </style>
</html>
