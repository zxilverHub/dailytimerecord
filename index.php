<?php
include("./system/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily time record</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header>
        <div class="left">
            <h1>Daily Time Record</h1>
            <p>Track your daily record, late, undertime, and overtime with Daily Time Record</p>
            <div class="ctas">
                <a href="login.php" class="cta">Log in</a>
                <a href="adminlog.php" class="cta admin">Admin</a>
            </div>
        </div>
        <div class="right">
            <img src="./assets/hero.png" alt="">
        </div>
    </header>

</body>

</html>