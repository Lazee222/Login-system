<?php

include "includes/db.php";

$message = "";

if(isset($_POST['verify'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        header("Location: reset_password.php?email=" . urlencode($email));
        exit();

    }else{

        $message = "Email not found.";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Forgot Password</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h2>Forgot Password</h2>

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
type="email"
name="email"
placeholder="Enter your Email"
required>

<button
type="submit"
name="verify">

Continue

</button>

</form>

<p>
<a href="login.php">
Back to Login
</a>
</p>

</div>

</body>

</html>