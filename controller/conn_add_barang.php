<?php 
include 'conn.php';
session_start();



    
    $stmt1 = $db2->prepare("INSERT INTO `barang` (id_barang, nama_barang, harga_barang) VALUES(?, ?, ?)");
    $stmt1->bind_param("sss", $nik, $nama, $jabatan);
    
    $nik = mysqli_real_escape_string($db2,$_POST['nik2']);
    $nama = mysqli_real_escape_string($db2,$_POST['nama2']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan2']);


    $stmt1->execute();
    $stmt1->close();
    
    header("location:../barang.php");



	



?>