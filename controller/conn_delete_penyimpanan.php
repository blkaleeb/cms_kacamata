<?php 
include 'conn.php';

    $stmt1 = $db2->prepare("DELETE from `penyimpanan_bahan_baku` where id_bahan_baku=? AND nik=? AND jumlah_penyimpanan=? AND tanggal_penyimpanan=?");
    $stmt1->bind_param("ssss", $id_bahan_baku, $nik, $jumlah_penyimpanan, $tanggal_penyimpanan);

    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku3']);
    $nik = mysqli_real_escape_string($db2,$_POST['nik3']);
    $jumlah_penyimpanan = mysqli_real_escape_string($db2,$_POST['jumlah_penyimpanan3']);
    $tanggal_penyimpanan = mysqli_real_escape_string($db2,$_POST['tanggal_penyimpanan3']);

    $stmt1->execute();
    $stmt1->close();

    header("location:../report_penyimpanan_bb.php?");

?>