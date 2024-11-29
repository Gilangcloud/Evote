<?php
session_start();
if (!isset($_SESSION['siswa'])) {
    header('location:./');
    exit;
}

define('BASEPATH', dirname(__FILE__));

require('./include/connection.php');

$thn = date('Y');
$dpn = date('Y') + 1;
$periode = $thn . '/' . $dpn;
$user_id = $_SESSION['siswa'];

// Mengupdate status pemilihan
$update = $con->prepare("UPDATE t_pilihan SET status = 'submitted' WHERE id_user = ? AND periode = ?");
$update->bind_param('ss', $user_id, $periode);
$update->execute();

// Mengupdate suara kandidat
$votes = $con->query("SELECT id_kandidat FROM t_pilihan WHERE id_user = '$user_id' AND periode = '$periode'");
while ($vote = $votes->fetch_assoc()) {
    $candidate_id = $vote['id_kandidat'];
    $con->query("UPDATE t_kandidat SET suara = suara + 1 WHERE id_kandidat = '$candidate_id'");
}

// Menghapus data pemilih jika sudah selesai
$delete = $con->prepare("DELETE FROM t_pemilih WHERE nis = ? AND periode = ?");
$delete->bind_param('ss', $user_id, $periode);
$delete->execute();

unset($_SESSION['siswa']);

header('location:./index.php?page=thanks');
exit;
?>
