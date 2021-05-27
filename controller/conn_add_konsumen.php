<?php 
include 'conn.php';
session_start();



    
    $stmt1 = $db2->prepare("INSERT INTO `konsumen` (id_konsumen, nama_perusahaan, alamat_perusahaan, no_telp_perusahaan, email_perusahaan) VALUES(?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $idKonE2, $namaPerusahaan, $alamatPerusahaan, $noTelp, $emailPerusahaan);
    
    
    $idKonE2 = mysqli_real_escape_string($db2,$_POST['idKonE2']);
    $namaPerusahaan = mysqli_real_escape_string($db2,$_POST['namaPerusahaan']);
    $alamatPerusahaan = mysqli_real_escape_string($db2,$_POST['alamatPerusahaan']);
    $noTelp = mysqli_real_escape_string($db2,$_POST['noTelp']);
    $noTelp = str_replace( "_", '', $noTelp);
    $emailPerusahaan = mysqli_real_escape_string($db2,$_POST['emailPerusahaan']);

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../konsumen.php");



	



?>