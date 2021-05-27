<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `kerusakan_bahan_baku` set id_bahan_baku=?, nik=?, jumlah_kerusakan=?, tanggal_pelaporan=? where id_bahan_baku=? AND nik=? AND jumlah_kerusakan=? AND tanggal_pelaporan=?");
    $stmt1->bind_param("ssssssss", $id_bahan_baku, $nik, $jumlah_kerusakan, $tanggal_kerusakan, $id_bahan_baku_lama, $nik_lama, $jumlah_kerusakan_lama, $tanggal_kerusakan_lama);
    
    $nik = $_POST['nik1'];
    $id_bahan_baku = mysqli_real_escape_string($db2,$_POST['idBahanBaku1']);
    $jumlah_kerusakan = mysqli_real_escape_string($db2,$_POST['jumlah_kerusakan1']);
    $tanggal_kerusakan = mysqli_real_escape_string($db2,$_POST['tanggal_kerusakan1']);

    $nik_lama = $_POST['nik2'];
    $id_bahan_baku_lama = mysqli_real_escape_string($db2,$_POST['idBahanBaku2']);
    $jumlah_kerusakan_lama = mysqli_real_escape_string($db2,$_POST['jumlah_kerusakan2']);
    $tanggal_kerusakan_lama = mysqli_real_escape_string($db2,$_POST['tanggal_kerusakan2']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../report_kerusakan.php");

?>