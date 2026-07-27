<?php

if(isset($_GET['timeout'])){

?>

<p style="color:red; text-align:center;">
    Session expired. Please login again.
</p>

<?php

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        .password-container{
            position: relative;
            width: 100%;
        }

        .password-container input{
            width: 100%;
            padding-right: 45px;
            box-sizing: border-box;
        }

        .toggle-password{
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            user-select: none;
        }
    </style>

</head>

<body>

<div class="container">

<h2>LOGIN</h2>

<?php

if(isset($_GET['error'])){

    if($_GET['error']=="wrongpassword"){

?>

<p style="color:red; text-align:center;">
     Wrong password! Please try again.
</p>

<?php

    }

    if($_GET['error']=="wronguser"){

?>

<p style="color:red; text-align:center;">
    Wrong Username or Email.
</p>

<?php

    }

}

?>

<form action="includes/login_process.php" method="POST">

<input
type="text"
name="username"
placeholder="Username or Email"
required>

<div class="password-container">

<input
type="password"
name="password"
id="password"
placeholder="Password"
required>

<span class="toggle-password" onclick="togglePassword()">👁</span>

</div>

<button type="submit">

Login

</button>

</form>

<p>
<a href="forgot_password.php">
Forgot Password?
</a>
</p>

<p>
Don't have an account?
<a href="register.php">
Sign Up
</a>
</p>

</div>

<script>
function togglePassword() {
    var password = document.getElementById("password");
    var icon = document.querySelector(".toggle-password");

    if (password.type === "password") {
        password.type = "text";
        icon.textContent = "🔍";
    } else {
        password.type = "password";
        icon.textContent = "👁";
    }
}
</script>

</body>

</html>