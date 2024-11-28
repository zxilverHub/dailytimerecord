<?php
include("./system/config.php");
session_start();


if (isset($_POST["login"])) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username == "admin" && $password == "admin") {
        $_SESSION["isadmin"] = true;
        header("Location: http://localhost/ajax_activity/admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin In</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <div id="container">
        <form action="" method="POST">
            <h1>Admin Log in</h1>
            <input type="text" placeholder="Username" name="username"><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="submit" value="Log in" name="login">
        </form>
    </div>
</body>

</html>