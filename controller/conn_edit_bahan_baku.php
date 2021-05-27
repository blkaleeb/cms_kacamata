<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `bahan_baku` set id_bahan_baku=?, nama_bahan_baku=?, uom=?, status_bahan_baku=?, minimum_stock=? where id_bahan_baku = ?");
    $stmt1->bind_param("ssssss", $nik, $nama, $jabatan, $noTelp, $stockMin, $nik2);
    
    $nik = $_POST['nik1'];
    $nik2 = $_POST['idKon1'];
    $nama = mysqli_real_escape_string($db2,$_POST['nama1']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan1']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp1']);
    $stockMin = mysqli_real_escape_string($db2,$_POST['stockMin1']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../bahan_baku.php");



	



?>