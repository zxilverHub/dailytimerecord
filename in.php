<?php
include("./system/config.php");
session_start();

if (!isset($_SESSION["userid"])) {
    header("Location: http://localhost/ajax_activity/login.php");
    exit();
}

$id = $_SESSION["userid"] ?? 0;
$sql = "select * from record where date(login) = current_date();";
$record = $conn->query($sql);

if ($record->num_rows > 0) {
    echo "Already logged today!";
} else {
    $goodtime = strtotime("08:00:00");
    $currentTime = time();

    $props = "(recordid, login, login_time, userid)";
    $values = "(null, now(), now(), $id)";

    if ($currentTime > $goodtime) {
        $late = ($currentTime - $goodtime) / 60;
        $props = "(recordid, login, login_time, late, userid)";
        $values = "(null, now(), now(), $late, $id)";
    }

    echo "Logged";
    $sql = "insert into record" . $props . " values " . $values;
    $conn->query($sql);
}
