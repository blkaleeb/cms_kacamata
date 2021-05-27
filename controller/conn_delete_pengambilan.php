<?php 
include 'conn.php';

    $stmt1 = $db2->prepare("DELETE from `pengambilan_bahan_baku` where id_bahan_baku=? AND nik=? AND jumlah_pengambilan=? AND tanggal_pengambilan=?");
    $stmt1->bind_param("ssss", $id_bahan_baku, $nik, $jumlah_pengambilan, $tanggal_pengambilan);

    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku3']);
    $nik = mysqli_real_escape_string($db2,$_POST['nik3']);
    $jumlah_pengambilan = mysqli_real_escape_string($db2,$_POST['jumlah_pengambilan3']);
    $tanggal_pengambilan = mysqli_real_escape_string($db2,$_POST['tanggal_pengambilan3']);

    $stmt1->execute();
    $stmt1->close();

    header("location:../report_pengambilan_bb.php?");

?>