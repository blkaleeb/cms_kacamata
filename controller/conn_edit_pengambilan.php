<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `pengambilan_bahan_baku` set id_bahan_baku=?, nik=?, jumlah_pengambilan=?, tanggal_pengambilan=? where id_bahan_baku=? AND nik=? AND jumlah_pengambilan=? AND tanggal_pengambilan=?");
    $stmt1->bind_param("ssssssss", $id_bahan_baku, $nik, $jumlah_pengambilan, $tanggal_pengambilan, $id_bahan_baku_lama, $nik_lama, $jumlah_pengambilan_lama, $tanggal_pengambilan_lama);
    
    $nik = $_POST['nik1'];
    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku1']);
    $jumlah_pengambilan = mysqli_real_escape_string($db2,$_POST['jumlah_pengambilan1']);
    $tanggal_pengambilan = mysqli_real_escape_string($db2,$_POST['tanggal_pengambilan1']);

    $nik_lama = $_POST['nik2'];
    $id_bahan_baku_lama = mysqli_real_escape_string($db2,$_POST['idBahanBaku2']);
    $jumlah_pengambilan_lama = mysqli_real_escape_string($db2,$_POST['jumlah_pengambilan2']);
    $tanggal_pengambilan_lama = mysqli_real_escape_string($db2,$_POST['tanggal_pengambilan2']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../report_pengambilan_bb.php");

?>