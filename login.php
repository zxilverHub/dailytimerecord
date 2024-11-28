<?php
include("./system/config.php");
session_start();

$logstatus = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    $sql = "select * from users where username = '$username' and password = '$password'";
    $logresult = $conn->query($sql);

    if ($logresult->num_rows > 0) {
        $logstatus = "";
        $_SESSION["userid"] = $logresult->fetch_assoc()["userid"];
        header("Location: http://localhost/ajax_activity/welcome.php");
    } else {
        $logstatus = "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="container">
        <form action="" method="POST">
            <h1>Log in</h1>
            <input type="text" placeholder="Username" name="username"><br>
            <input type="password" placeholder="Password" name="password"><br>
            <input type="submit" value="Log in" name="login">
        </form>
    </div>
</body>

</html>