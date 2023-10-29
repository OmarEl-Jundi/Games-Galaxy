<?php
$error1 = ''; // Variable To Store Error Message
if (isset($_POST['signin'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error1 = "Username or Password empty";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require 'connection.php';
        $q = "select * from `User` where (username='" . $username . "' OR email='" . $username . "') AND password='" . $password . "'";
        $result = mysqli_query($con, $q);
        if ($result === false) {
            die("Error executing the query: " . mysqli_error($con));
        } else {
            $res = mysqli_num_rows($result);
        }
        if ($res == 1) { //the sign in is successful, matching is correct

            $row = mysqli_fetch_array($result);

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user_role"] = $row['role'];

            header("location: index.php");
            exit();
        } else { //matching is not correct
            $error1 = "Username or Password is invalid";
        }
        mysqli_close($con); // Closing Connection
    }
}
?>

<html>

<head>
    <title>Login</title>
    <link href="style-presets.css" rel="stylesheet" type="text/css">
</head>
<header>
    <div class="nav container">
        <div class="logo">
            <a href="index.php" class="">Games Galaxy</a>
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
            }
            ?>
        </div>


        <div class="wrapper">
            <div class="card-switch">
                <label class="switch">
                    <input class="toggle" type="checkbox">
                    <span class="slider"></span>
                    <span class="card-side"></span>
                    <div class="flip-card__inner">
                        <div class="flip-card__front">
                            <div class="title">Log in</div>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <input type="text" placeholder="Email or Username" name="username" class="flip-card__input">
                                <input type="password" placeholder="Password" name="password" class="flip-card__input">
                                <div class="error-container">
                                    <span class="error"><?php echo $error1; ?></span>
                                </div>
                                <input name="signin" class="flip-card__btn" type="submit" value=" Login ">
                            </form>
                        </div>
                        <div class="flip-card__back">
                            <p class="title">Sign up</p>

                            <div id="fname-lname">
                                <input type="text" placeholder="First Name" id="fname" name="fname" class="flip-card__input">
                                <input type="text" placeholder="Last Name" id="lname" name="lname" class="flip-card__input">
                            </div>
                            <input type="text" placeholder="Username" class="flip-card__input" id="username" name="username">
                            <input type="email" placeholder="Email" id="email" name="email" class="flip-card__input" required>
                            <input type="password" placeholder="Password" id="password" name="password" class="flip-card__input">
                            <input type="password" placeholder="Confirm Password" id="re_password" name="re_password" class="flip-card__input">
                            <input type="date" placeholder="Date of Birth" id="dob" name="dob" class="flip-card__input">
                            <div class="error-container">
                                <div id="error-message" class="error"></div>
                                <div id="ajaxDiv"></div>
                            </div>
                            <div>
                                <button class="flip-card__btn" onclick="signup()">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        </div>

</html>
<style>
    .error,
    .ajaxDiv {
        position: static;
        top: 100%;
        /* Adjust this value as needed to control the vertical position */
        color: red;
    }


    .error-container {
        margin-top: 10%;
        position: relative;
    }


    body {
        background: linear-gradient(to right, firebrick, rgb(24, 24, 24));
    }
</style>
<script>
    document.getElementById('username').addEventListener("input", (e) => {
        checkUsernameAvailability();
    });
    document.getElementById('email').addEventListener("input", (e) => {
        checkEmailAvailability();
    });
    // document.getElementById('email').addEventListener('blur', validateEmail());
    // document.getElementById('email').addEventListener('input', checkEmailAvailability());

    function validateEmail(email) {
        // Regular expression to check for a valid email format
        var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        return emailRegex.test(email);
    }

    function checkUsernameAvailability() {
        var errorDiv = document.getElementById('error-message');
        var username = document.getElementById('username').value;
        var ajaxRequest = new XMLHttpRequest();
        ajaxRequest.onreadystatechange = function() {
            if (ajaxRequest.readyState == 4) {
                var ajaxDisplay = document.getElementById('ajaxDiv');
                if (ajaxRequest.responseText === "available") {
                    errorDiv.innerHTML = "Username available";
                } else if (ajaxRequest.responseText === "taken") {
                    errorDiv.innerHTML = "Username is already taken. Please choose another.";
                } else if (ajaxRequest.responseText === "unavailable") {
                    errorDiv.innerHTML = "Username can't be empty";
                }
            }
        }

        var queryString = "?username=" + username;
        ajaxRequest.open("GET", "check-username-availability.php" + queryString, true);
        ajaxRequest.send(null);
    }

    function checkEmailAvailability() {
        var errorDiv = document.getElementById('error-message');
        var email = document.getElementById('email').value;

        var ajaxRequest = new XMLHttpRequest();
        ajaxRequest.onreadystatechange = function() {
            if (ajaxRequest.readyState == 4) {
                var ajaxDisplay = document.getElementById('ajaxDiv');
                if (ajaxRequest.responseText === "available") {
                    errorDiv.innerHTML = "Email is available.";
                } else if (ajaxRequest.responseText === "taken") {
                    errorDiv.innerHTML = "Email is already taken. Please choose another.";
                }
            }
        }

        var queryString = "?email=" + email;
        ajaxRequest.open("GET", "check-email-availability.php" + queryString, true);
        ajaxRequest.send(null);
    }


    function signup() {

        var ajaxRequest = new XMLHttpRequest();
        ajaxRequest.onreadystatechange = function() {
            if (ajaxRequest.readyState == 4) {
                var ajaxDisplay = document.getElementById('ajaxDiv');
                errorDiv.innerHTML = ajaxRequest.responseText;
            }
        }

        var errorDiv = document.getElementById('error-message'); // Get the error div

        var fname = document.getElementById('fname').value;
        var lname = document.getElementById('lname').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var re_password = document.getElementById('re_password').value;
        var dob = document.getElementById('dob').value;

        if (fname === "") {
            errorDiv.innerHTML = "Please enter your first name";
        } else if (lname === "") {
            errorDiv.innerHTML = "Please enter your last name";
        } else if (username === "") {
            errorDiv.innerHTML = "Please enter a username";
        } else if (email === "") {
            errorDiv.innerHTML = "Please enter your email";
        } else if (!validateEmail(email)) {
            errorDiv.innerHTML = "Please enter a valid email address";
        } else if (password === "") {
            errorDiv.innerHTML = "Please enter a password";
        } else if (re_password === "") {
            errorDiv.innerHTML = "Please re-enter your password";
        } else if (password !== re_password) {
            errorDiv.innerHTML = "Passwords do not match";
        } else if (dob === "") {
            errorDiv.innerHTML = "Please enter your date of birth";
        } else {
            var queryString = "?fname=" + fname + "&lname=" + lname +
                "&username=" + username + "&email=" + email +
                "&password=" + password +
                "&dob=" + dob;
            ajaxRequest.open("GET", "signup-process.php" + queryString, true);
            ajaxRequest.send(null);
        }

    }
</script>