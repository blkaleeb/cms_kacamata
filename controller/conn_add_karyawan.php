<?php 
include 'conn.php';
session_start();



    
    $stmt1 = $db2->prepare("INSERT INTO `user` (nik, nama, jabatan, nomor_telp, alamat) VALUES(?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $nik, $nama, $jabatan, $noTelp, $alamat);
    
    $nik = mysqli_real_escape_string($db2,$_POST['nik2']);
    $nama = mysqli_real_escape_string($db2,$_POST['nama2']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan2']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp2']);
    $noTelp = str_replace( "_", '', $noTelp);
    $alamat = mysqli_real_escape_string($db2,$_POST['alamat2']);

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../karyawan.php");



	



?>