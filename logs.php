<?php
include("./system/config.php");
session_start();


if (!isset($_SESSION["userid"])) {
    header("Location: http://localhost/ajax_activity/login.php");
    exit();
}

$id = $_SESSION["userid"] ?? 0;
$sql = "select * from record where userid = $id";

$row = $conn->query($sql);

?>

<table>
    <tr>
        <th>In</th>
        <th>In time</th>
        <th>Out</th>
        <th>Out time</th>
        <th>Late</th>
        <th>Undertime</th>
        <th>Overtime</th>
    </tr>
    <?php
    while ($user = $row->fetch_assoc()) {
    ?>

        <tr>
            <td><?php echo $user["login"] ?></td>
            <td><?php echo $user["login_time"] ?></td>
            <td><?php echo $user["logout"] ?></td>
            <td><?php echo $user["logout_time"] ?></td>
            <td><?php echo $user["late"] . " mins"; ?></td>
            <td><?php echo $user["undertime"] . " mins" ?></td>
            <td><?php echo $user["overtime"] . " mins"; ?></td>
        </tr>

    <?php } ?>

</table>