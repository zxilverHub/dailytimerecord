<?php
include("./system/config.php");
session_start();


if (!isset($_SESSION["isadmin"])) {
    header("Location: http://localhost/ajax_activity/adminlog.php");
    exit();
}


if (isset($_POST["logout"])) {
    header("Location: http://localhost/ajax_activity/index.php");
    session_destroy();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./system//jquery.js"></script>
    <script>
        $(document).ready(() => {
            loadUsers();
        });

        function loadUsers() {
            $("#main").load("users.php");
        }

        function exportReport() {
            window.location.href = 'export.php?export=1';
        }
    </script>
</head>

<body>
    <button class="export" onclick="exportReport()">Export Report</button>

    <form action="" method="POST" class="logout">
        <input type="submit" value="Log out" name="logout">
    </form>

    <div id="container">
        <div id="main"></div>
    </div>

</body>

</html>