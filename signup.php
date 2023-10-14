<?php
$error = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['re_password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $ready = 0;
    require 'connection.php';
    $query = "SELECT * FROM `User` WHERE username = '" . $username . "'";
    $result = mysqli_query($con, $query);
    $res = mysqli_num_rows($result);
    if ($res > 0) {
        $error = "Username Already Taken";
    } else {
        $query = "SELECT * FROM `User` WHERE email = '" . $email . "'";
        $result = mysqli_query($con, $query);
        $res = mysqli_num_rows($result);
        if ($res > 0) {
            $error = "Email Already Taken";
        } else if (strlen($password) < 8) {
            $error = "Password should be at least 8 character long";
        } else if (!preg_match("/[a-z]/i", $password)) {
            $error = "Password should have at least 1 Letter";
        } else if (!preg_match("/[1-9]/", $password)) {
            $error = "Password should have at least 1 Number";
        } else {
            $ready = 1;
        }
    }
    if ($ready === 1) {
        $query = "INSERT INTO `User`(`username`, `email`, `password`, `date_of_birth`, `fname`, `lname`, `role`) VALUES ('$username', '$email', '$password', '$dob', '$fname', '$lname',2)";
        mysqli_query($con, $query);
        header("Location: signup-success.html");
        exit();
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <div class="nav container">
        <div class="logo">
            <img id="logo-img" src="uploads/Logo.png" alt="" />
            <a href="#" class="">Games Galaxy</a>
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
    </div>
</header>

<body>
    <div id="main">
        <h1>Sign Up to Games Galaxy</h1>
        <div id="login">
            <h2>Sign Up Form</h2>
            <form id="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <p><label for="username">Enter your Username:</label></p>
                <input id="username" name="username" placeholder="username" type="text" required>
                <p><label for="email">Enter your Email:</label></p>
                <input id="email" name="email" placeholder="Email" type="email" required>
                <p><label for="password">Enter your Password :</label></p>
                <input id="password" name="password" placeholder="**********" type="password" required>
                <p><label for="re_password">Retype your Password :</label></p>
                <input id="re_password" name="re_password" placeholder="**********" type="password" required>
                <p><label for="fname">Enter your First Name:</label></p>
                <input id="fname" name="fname" placeholder="First Name" type="text" required>
                <p><label for="username">Enter your Last Name:</label></p>
                <input id="lname" name="lname" placeholder="Last Name" type="text" required>
                <p><label for="dob">Enter your Date of Birth:</label></p>
                <input id="dob" name="dob" placeholder="Date of Birth" type="date" required>
                <input name="submit" type="submit" value=" Sign Up ">
                <span><?php echo $error; ?></span>
            </form>
            <div id="login-bottom" align=center>
                <a href="index.php">Go Back</a> <b>- OR -</b> <a href="login.php">Log In</a>
            </div>
        </div>
    </div>
</body>

</html>