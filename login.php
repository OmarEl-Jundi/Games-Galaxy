<?php
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password empty";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require 'connection.php';
        $q = "select * from `User` where (username='" . $username . "' OR email='" . $username . "') AND password='" . $password . "'";
        $result = mysqli_query($con, $q);
        if ($result === false) {
            die("Error executing the query: " . mysqli_error($con));
        }else{
            $res = mysqli_num_rows($result);
        }
        if ($res == 1) { //the sign in is successful, matching is correct

            $row = mysqli_fetch_array($result);

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $row['id'];

            header("location: index.php");
            exit();

        } else {//matching is not correct
            $error = "Username or Password is invalid";
        }
        mysqli_close($con); // Closing Connection
    }
}
?>
<html>
<head>
    <title>Login</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
    <h1>Login to Games Galaxy</h1>
    <div id="login">
        <h2>Login Form</h2>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <p><label>Enter your username or email:</label></p>
            <input id="name" name="username" placeholder="username OR email" type="text">
            <p><label>Enter your password :</label></p>
            <input id="password" name="password" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
            <p><A id="signupbtn" Href="signup.php" align="center"> Sign up </A></p>
        </form>
        <div align=center>
            <a href="index.php">Go Back</a> <b>-    OR    -</b> <a href="signup.php">Sign Up</a>
        </div>
    </div>
</div>
</body>
</html>