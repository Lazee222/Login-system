<?php

session_start();

include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM users
WHERE username='$username'
OR email='$username'";


$result = $conn->query($sql);


if($result->num_rows > 0)
{

    $row = $result->fetch_assoc();


    if(password_verify($password,$row['password']))
    {

        $_SESSION['username']=$row['username'];
        $_SESSION['login_time']=time();

        header("Location: ../dashboard.php");
        exit();

    }
    else
    {

        // Wrong password
        header("Location: ../login.php?error=wrongpassword");
        exit();

    }

}
else
{

    header("Location: ../login.php?error=wronguser");
    exit();

}

?>