<?php
session_start();
if(!isset($_SESSION['siswa']) || !isset($_POST['candidates'])) {
   header('location:./');
}

define('BASEPATH', dirname(__FILE__));

require('./include/connection.php');

$thn     = date('Y');
$dpn     = date('Y') + 1;
$periode = $thn.'/'.$dpn;

$candidates = $_POST['candidates'];

// Cek apakah pengguna telah memilih 10 kandidat
if (count($candidates) != 10) {
    // Jika tidak, tampilkan alert dan kembali ke halaman sebelumnya
    // Simpan jawaban sebelumnya ke dalam session
    $_SESSION['jawaban_sebelumnya'] = $candidates;
    echo '<script>alert("Silahkan memilih 10 kandidat!"); history.back();</script>';
    exit;
}

// Update the votes for each candidate
foreach ($candidates as $candidateId) {
    $suara = 1;
    $update  = $con->prepare("UPDATE t_kandidat SET suara = suara + ? WHERE id_kandidat = ?") or die($con->error);
    $update->bind_param('is', $suara, $candidateId);
    $update->execute();
}

// Save the voter's data
$save = $con->prepare("INSERT INTO t_pemilih(nis, periode) VALUES(?,?)") or die($con->error);
$save->bind_param('ss', $_SESSION['siswa'], $periode);
$save->execute();

unset($_SESSION['siswa']);

header('location:./index.php?page=thanks');
?>  