<?php 
include 'conn.php';
session_start();



    
$stmt1 = $db2->prepare("INSERT INTO `supplier` (id_supplier, nama_toko, no_telp_toko, alamat_toko, email, no_rekening) VALUES(?, ?, ?, ?, ?, ?)");
$stmt1->bind_param("ssssss", $nik, $nama, $notelp, $alamat, $email, $norek);

$nik = mysqli_real_escape_string($db2,$_POST['nik2']);
$nama = mysqli_real_escape_string($db2,$_POST['nama2']);
$notelp = mysqli_real_escape_string($db2,$_POST['notelp2']);
$notelp = str_replace( "_", '', $notelp);
$alamat = mysqli_real_escape_string($db2,$_POST['alamat2']);
$email = mysqli_real_escape_string($db2,$_POST['email2']);
$norek = mysqli_real_escape_string($db2,$_POST['norek2']);

$stmt1->execute();
$stmt1->close();

header("location:../supplier.php");



	



?>