<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `barang` set id_barang=?, nama_barang=?, harga_barang=? where id_barang = ?");
    $stmt1->bind_param("ssss", $nik, $nama, $jabatan, $nik2);
    
    $nik = $_POST['nik1'];
    $nik2 = $_POST['idKon1'];
    $nama = mysqli_real_escape_string($db2,$_POST['nama1']);
    $jabatan = mysqli_real_escape_string($db2,$_POST['jabatan1']);

    $stmt1->execute();
    $stmt1->close();
    echo $nik2;
    header("location:../barang.php");



	



?>