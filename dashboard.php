<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<div class="container">


<h1>
Welcome <?php echo $_SESSION['username']; ?>
</h1>


<h3 id="timer" style="color:red;">
Session expires in 20 seconds
</h3>


<a href="includes/logout.php">
Logout
</a>


</div>



<script>

let timeLeft = 20;
let timer;


function startTimer(){

    clearInterval(timer);

    timer = setInterval(function(){

        timeLeft--;


        document.getElementById("timer").innerHTML =
        "Session expires in " + timeLeft + " seconds";


        if(timeLeft <= 0){

            clearInterval(timer);

            window.location.href="includes/logout.php";

        }


    },1000);

}



function resetTimer(){

    timeLeft = 20;

    document.getElementById("timer").innerHTML =
    "Session expires in " + timeLeft + " seconds";

}


startTimer();


document.addEventListener("click", resetTimer);


</script>


</body>

</html>