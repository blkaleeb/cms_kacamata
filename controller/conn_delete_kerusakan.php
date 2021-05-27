<?php 
include 'conn.php';

    $stmt1 = $db2->prepare("DELETE from `kerusakan_bahan_baku` where id_bahan_baku=? AND nik=? AND jumlah_kerusakan=? AND tanggal_pelaporan=?");
    $stmt1->bind_param("ssss", $id_bahan_baku, $nik, $jumlah_kerusakan, $tanggal_kerusakan);

    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku3']);
    $nik = mysqli_real_escape_string($db2,$_POST['nik3']);
    $jumlah_kerusakan = mysqli_real_escape_string($db2,$_POST['jumlah_kerusakan3']);
    $tanggal_kerusakan = mysqli_real_escape_string($db2,$_POST['tanggal_kerusakan3']);

    $stmt1->execute();
    $stmt1->close();

    header("location:../report_kerusakan.php?");

?>