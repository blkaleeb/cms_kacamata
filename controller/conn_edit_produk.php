<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `produk` set nama =?,  deskripsi =?, discount =?, harga =? ,gambar =? where id_produk = ?");
    $stmt1->bind_param("ssssss", $nama, $deskripsi, $discount, $harga, $gambar, $id_produk );
    
    $nama = mysqli_real_escape_string($db2,$_POST['namaProduk']);
    $deskripsi = mysqli_real_escape_string($db2,$_POST['deskripsi']);
    $discount = mysqli_real_escape_string($db2,$_POST['discount']);
    $harga = mysqli_real_escape_string($db2,$_POST['harga']);
    $gambar = "";
    $id_produk = mysqli_real_escape_string($db2,$_POST['idProduk']);

    $b = str_replace( ',', '', $harga );

    if( is_numeric( $b ) ) {
        $harga = $b;
    }

    echo ' <br> id_produk:  '.$id_produk;
    echo ' <br> nama:  '.$nama;
    echo ' <br> deskripsi: '.$deskripsi;
    echo ' <br> discount: '.$discount;
    echo ' <br> harga: '.$harga;


    $stmt1->execute();
    $stmt1->close();
    
    header("location:../produk.php");

?>