<?php

include "includes/db.php";

$message = "";

if(isset($_POST['register'])){

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Password Validation
    if($password != $confirm){

        $message = "Passwords do not match.";

    }
    elseif(strlen($password) < 8){

        $message = "Password must be at least 8 characters long.";

    }
    elseif(!preg_match('/[A-Z]/', $password)){

        $message = "Password must contain at least one uppercase letter.";

    }
    elseif(!preg_match('/[0-9]/', $password)){

        $message = "Password must contain at least one number.";

    }
    else{

        // Check if email already exists
        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $resultEmail = mysqli_query($conn, $checkEmail);

        if(mysqli_num_rows($resultEmail) > 0){

            $message = "This email is already registered.";

        }else{

            // Check if username already exists
            $checkUser = "SELECT * FROM users WHERE username='$username'";
            $resultUser = mysqli_query($conn, $checkUser);

            if(mysqli_num_rows($resultUser) > 0){

                $message = "This username is already taken.";

            }else{

                // Hash Password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (fullname, username, email, password)
                        VALUES ('$fullname','$username','$email','$hashed_password')";

                if(mysqli_query($conn, $sql)){

                    $message = "Account created successfully! Redirecting...";
                    header("refresh:2;url=login.php");

                }else{

                    $message = "Registration failed.";

                }

            }

        }

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Create Account</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        .password-container{
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .password-container input{
            width: 100%;
            padding-right: 45px;
            box-sizing: border-box;
        }

        .toggle-password{
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            user-select: none;
        }
    </style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<?php if($message != ""){ ?>

<p style="
    color:#b91c1c;
    background:#fee2e2;
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:15px;
">
    <?php echo $message; ?>
</p>

<?php } ?>

<form method="POST">

<input
type="text"
name="fullname"
placeholder="Full Name"
required>

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="email"
name="email"
placeholder="Email Address"
required>

<div class="password-container">
    <input
    type="password"
    name="password"
    id="password"
    placeholder="Password"
    required>

    <span class="toggle-password" onclick="togglePassword('password', this)">👁</span>
</div>
<div class="password-container">
    <input
    type="password"
    name="confirm"
    id="confirm"
    placeholder="Confirm Password"
    required>

    <span class="toggle-password" onclick="togglePassword('confirm', this)">👁</span>
</div>

<button type="submit" name="register">
Create Account
</button>

</form>

<p>
Already have an account?
<a href="login.php">Login</a>
</p>

</div>


<script src="js/script.js"></script>
</body>

</html>