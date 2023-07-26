<?php
session_start();

// Check if the POST data contains the 'gameIds' array
if (isset($_POST['gameIds']) && is_array($_POST['gameIds'])) {
    // Store the game IDs in the PHP session
    $_SESSION['game_ids'] = $_POST['gameIds'];
    // Respond with a success message
    echo json_encode(array('status' => 'success'));
} else {
    // Respond with an error message
    echo json_encode(array('status' => 'error', 'message' => 'Invalid data'));
}

?>
