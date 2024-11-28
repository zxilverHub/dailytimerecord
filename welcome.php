<?php
include("./system/config.php");
session_start();


if (!isset($_SESSION["userid"])) {
    header("Location: http://localhost/ajax_activity/login.php");
    exit();
}

$id = $_SESSION["userid"];
$sql = "select * from users where userid = $id";
$user = $conn->query($sql);

if (isset($_POST["logout"])) {
    session_destroy();

    header("Location: http://localhost/ajax_activity/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily time record</title>
    <link rel="stylesheet" href="./style.css">

    <script src="./system//jquery.js"></script>
    <script>
        $(document).ready(() => {
            loadLogs();
        });

        function loadLogs() {
            $("#main").load("logs.php");
        }

        function recordin() {
            $.post("in.php", {
                    id: "0"
                },
                function(data, status) {
                    loadLogs();
                    alert(data);
                });
        }

        function recordOut() {
            $.post("out.php", {
                    id: "0"
                },
                function(data, status) {
                    loadLogs();
                    alert(data);
                });
        }
    </script>
</head>

<body>
    <form action="" method="POST" class="logout">
        <input type="submit" value="Log out" name="logout">
    </form>

    <div id="container">
        <h2>
            Current date:
            <?php echo date("Y-d-m"); ?>
        </h2>
        <button onclick="recordin()">In</button>
        <button onclick="recordOut()">Out</button>
        <div id="main"></div>
    </div>
</body>

</html>