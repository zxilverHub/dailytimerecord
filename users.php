<?php
include("./system/config.php");
session_start();

$sql = "
    select *, sum(users.userid) as noofemp from users
    join record where record.userid = users.userid
    group by record.recordid
    ";

$users = $conn->query($sql);
$nofemp = $conn->query($sql)->fetch_assoc()["noofemp"];

if ($users->num_rows > 0) {

?>
    <h2>Number of employees: <?php echo $nofemp ?></h2>
    <table>
        <tr>
            <th>User id</th>
            <th>Username</th>
            <th>In</th>
            <th>In time</th>
            <th>Out</th>
            <th>Out time</th>
            <th>Late</th>
            <th>Undertime</th>
            <th>Overtime</th>
        </tr>

        <?php
        while ($row = $users->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["userid"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td><?php echo $row["login"] ?></td>
                <td><?php echo $row["login_time"] ?></td>
                <td><?php echo $row["logout"] ?></td>
                <td><?php echo $row["logout_time"] ?></td>
                <td><?php echo $row["late"] . " mins"; ?></td>
                <td><?php echo $row["undertime"] . " mins" ?></td>
                <td><?php echo $row["overtime"] . " mins"; ?></td>
            </tr>
    <?php
        }
    } else {
        echo "No users";
    }
    ?>

    </table>