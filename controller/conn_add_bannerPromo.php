<?php 
include 'conn.php';
session_start();
    
    $stmt1 = $db2->prepare("INSERT INTO `bannerPromo` (harga, judul, tanggal_berlaku, status_banner)
                            VALUES(?, ?, ?, ?)");
    $stmt1->bind_param("ssss", $harga, $judul, $tanggal_berlaku, $status_banner);
    
    $harga = mysqli_real_escape_string($db2,$_POST['harga']);
    $judul = mysqli_real_escape_string($db2,$_POST['judul']);
    $tanggal_berlaku = mysqli_real_escape_string($db2,$_POST['tanggal_berlaku']);
    $status_banner = mysqli_real_escape_string($db2,$_POST['status_banner']);

    echo '<br> harga: '.$harga ;
    echo '<br> judul: '.$judul ;
    echo '<br> tanggal_berlaku: '.$tanggal_berlaku ;
    echo '<br> status_banner: '.$status_banner ;

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../banner_promo.php");



	



?>