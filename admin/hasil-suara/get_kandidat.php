<?php


ob_start();

session_start();
if (!isset($_SESSION['id_admin'])) {
    header('location: ./');
}
define('BASEPATH', dirname(__FILE__));






require('../../include/connection.php');

header('Content-Type: application/json');

$sql = mysqli_query($con, "SELECT * FROM t_kandidat ORDER BY suara DESC");

$data = [];
if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }
}



echo json_encode($data);
