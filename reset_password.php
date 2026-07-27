<?php

include "includes/db.php";

$message = "";

$email = $_GET['email'];

if(isset($_POST['reset'])){

    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if($password != $confirm){

        $message = "Passwords do not Match.";

    }else{

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "
        UPDATE users
        SET password='$hash'
        WHERE email='$email'
        ";

        if(mysqli_query($conn, $sql)){

            $message = "Changed successfully! Please Wait...";

            header("refresh:2;url=login.php");

        }else{

            $message = "Something went wrong.";

        }

    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Reset Password</title>

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

<h2>
Create New Password
</h2>

<p>
<?php echo $message; ?>
</p>

<form method="POST">

<div class="password-container">

<input
type="password"
name="password"
id="password"
placeholder="New Password"
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

<button name="reset">

Change Password

</button>

</form>

<p>
<a href="login.php">
Back to Login
</a>
</p>

</div>

<script src="js/script.js"></script>

</body>

</html>