<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `penyimpanan_bahan_baku` set id_bahan_baku=?, nik=?, jumlah_penyimpanan=?, tanggal_penyimpanan=? where id_bahan_baku=? AND nik=? AND jumlah_penyimpanan=? AND tanggal_penyimpanan=?");
    $stmt1->bind_param("ssssssss", $id_bahan_baku, $nik, $jumlah_penyimpanan, $tanggal_penyimpanan, $id_bahan_baku_lama, $nik_lama, $jumlah_penyimpanan_lama, $tanggal_penyimpanan_lama);
    
    $nik = $_POST['nik1'];
    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku1']);
    $jumlah_penyimpanan = mysqli_real_escape_string($db2,$_POST['jumlah_penyimpanan1']);
    $tanggal_penyimpanan = mysqli_real_escape_string($db2,$_POST['tanggal_penyimpanan1']);

    $nik_lama = $_POST['nik2'];
    $id_bahan_baku_lama = mysqli_real_escape_string($db2,$_POST['idBahanBaku2']);
    $jumlah_penyimpanan_lama = mysqli_real_escape_string($db2,$_POST['jumlah_penyimpanan2']);
    $tanggal_penyimpanan_lama = mysqli_real_escape_string($db2,$_POST['tanggal_penyimpanan2']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../report_penyimpanan_bb.php");

?>