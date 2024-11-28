<?php
include("./system/config.php");
session_start();

if (!isset($_SESSION["userid"])) {
    header("Location: http://localhost/ajax_activity/login.php");
    exit();
}

$id = $_SESSION["userid"] ?? 0;

$sql = "SELECT * FROM record WHERE DATE(login) = CURRENT_DATE() AND userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$record = $stmt->get_result();

if ($record->num_rows == 0) {
    echo "Log In First";
} else {
    $row = $record->fetch_assoc();
    $rid = $row["recordid"];

    $worktime = 480; // 8 hours in minutes
    $currentTime = time(); // Current timestamp
    $loginTime = strtotime($row["login_time"]); // User's login timestamp

    $working = ($currentTime - $loginTime) / 60;

    $undertime = $working < $worktime ? $worktime - $working : 0;
    $overtime = $working > $worktime ? $working - $worktime : 0;

    $updateSql = "UPDATE record 
                  SET logout = NOW(), 
                      logout_time = NOW(), 
                      undertime = ?, 
                      overtime = ? 
                  WHERE recordid = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ddi", $undertime, $overtime, $rid);
    if ($updateStmt->execute()) {
        echo "Logged Out Successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
