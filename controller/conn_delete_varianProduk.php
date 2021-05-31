<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `varian` where id_produk = ? AND gambar= ? ");
    $stmt3->bind_param("ss",  $id_produk, $gambar);

    $id_produk = $_GET['id_produk'];
    $gambar = $_GET['gambar'];
    echo "cc = ".$id_produk;
    echo "gambar = ".$gambar;

    $stmt3->execute();
    $stmt3->close();

    header("location:../produk.php?");
    
?>