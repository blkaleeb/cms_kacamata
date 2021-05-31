<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `produk` where id_produk = ? ");
    $stmt3->bind_param("s",  $id_produk);

    $id_produk = $_GET['id_produk'];
    echo "cc = ".$id_produk;

    $stmt3->execute();
    $stmt3->close();

    header("location:../produk.php?");
    
?>