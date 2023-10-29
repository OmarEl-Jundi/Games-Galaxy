<html>

<head>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="adminstyle.css">
</head>
<?php
require 'connection.php';
session_start();
if ($_SESSION["user_role"] != 1) {
    header("location: index.php");
}
?>
<h1 align="center">List of Games</h1>
<p align="center"><a href="admin-home.php">Go Back to Main Menu</a></p>
<div id="scrollToTopBtn" class="scroll-to-top-button" onclick="scrollToTop()">&#8679; Scroll to Top</div>
<table border="1" width="50%" bgcolor="black" align="center">
    <tr style="color: aliceblue">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Developer</th>
        <th>Image</th>
    </tr>

    <?php
    $query = "SELECT * FROM `Games`";
    require 'connection.php';
    $result = mysqli_query($con, $query);
    $x = 0;
    while ($row = mysqli_fetch_array($result)) {
        if ($x % 2 == 0) {
            echo '<tr align=center bgcolor="#b22222" >';
        } else {
            echo '<tr align=center bgcolor="gray" >';
        }
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['developer'] . "</td>";
        echo "<td><img width='150' height='200' src='{$row['image']}'></td>";
        echo "</tr>";
        $x++;
    }
    mysqli_close($con);
    ?>
</table>
<style>
    table {
        margin-left: 350px;
    }

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