<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `user` set nik=?, nama=?, jabatan=?, nomor_telp=?, alamat=? where nik = ?");
    $stmt1->bind_param("ssssss", $nik, $nama, $jabatan, $noTelp, $alamat, $nik2);
    
    $nik = $_POST['nik1'];
    $nik2 = $_POST['idKon1'];
    $nama = mysqli_real_escape_string($db2,$_POST['nama1']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan1']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp1']);
    $noTelp = str_replace( "_", '', $noTelp);
    $alamat = mysqli_real_escape_string($db2,$_POST['alamat1']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../karyawan.php");



	



?>