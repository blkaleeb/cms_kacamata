<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `konsumen` set id_konsumen = ?, nama_perusahaan=?, alamat_perusahaan=?, no_telp_perusahaan=?, email_perusahaan=? where id_konsumen = ?");
    $stmt1->bind_param("ssssss", $idKonE, $namaPerusahaan, $alamatPerusahaan, $noTelp, $emailPerusahaan, $idAcc );
    
    $idKonE = mysqli_real_escape_string($db2,$_POST['idKonE']);
    $namaPerusahaan = mysqli_real_escape_string($db2,$_POST['namaPerusahaan1']);
    $alamatPerusahaan = mysqli_real_escape_string($db2,$_POST['alamatPerusahaan1']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp1']);
    $noTelp = str_replace( "_", '', $noTelp);
    $emailPerusahaan = mysqli_real_escape_string($db2,$_POST['emailPerusahaan1']);
    $idAcc = mysqli_real_escape_string($db2,$_POST['idKon1']);

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../konsumen.php");



	



?>