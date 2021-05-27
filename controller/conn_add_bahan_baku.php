<?php 
include 'conn.php';
session_start();



    
    $stmt1 = $db2->prepare("INSERT INTO `bahan_baku` (id_bahan_baku, nama_bahan_baku, stok_bahan_baku, uom, status_bahan_baku, minimum_stock)
                            VALUES(?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("ssssss", $nik, $nama, $stock, $jabatan, $noTelp, $stockMin);
    
    $stock=0;
    $nik = mysqli_real_escape_string($db2,$_POST['nik2']);
    $nama = mysqli_real_escape_string($db2,$_POST['nama2']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan2']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp2']);
    $stockMin = mysqli_real_escape_string($db2,$_POST['stockMin2']);


    $stmt1->execute();
    $stmt1->close();
    
    header("location:../bahan_baku.php");



	



?>