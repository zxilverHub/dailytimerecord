<?php
include("./system/config.php");

if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=hr_report.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Employee ID', 'Name', 'Date', 'Login Time', 'Logout Time', 'Undertime (mins)', 'Overtime (mins)']);

    $sql = "select *, sum(users.userid) as noofemp from users
    join record where record.userid = users.userid
    group by record.recordid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }
    }

    fclose($output);
    exit();
}
