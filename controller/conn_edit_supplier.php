<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `supplier` set id_supplier = ?, nama_toko=?, no_telp_toko=?, alamat_toko=?, email=?, no_rekening=? where id_supplier = ?");
    $stmt1->bind_param("sssssss", $nik, $nama, $notelp, $alamat, $email, $norek,$idKon );
    
    $nik = mysqli_real_escape_string($db2,$_POST['nik1']);
    $nama = mysqli_real_escape_string($db2,$_POST['nama1']);
    $notelp = mysqli_real_escape_string($db2,$_POST['notelp1']);
    $notelp = str_replace( "_", '', $notelp);
    $alamat = mysqli_real_escape_string($db2,$_POST['alamat1']);
    $email = mysqli_real_escape_string($db2,$_POST['email1']);
    $norek = mysqli_real_escape_string($db2,$_POST['norek1']);
    $idKon = mysqli_real_escape_string($db2,$_POST['idKon1']);

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../supplier.php");



	



?>