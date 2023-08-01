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
</style>