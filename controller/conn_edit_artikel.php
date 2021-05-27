<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `artikel` set judul = ?, tags=?, id_kategori=?, deskripsi=? where id_article = ?");
    $stmt1->bind_param("sssss", $judul, $tags, $id_category, $deskripsi, $id_article );
    
    $judul = mysqli_real_escape_string($db2,$_POST['judul']);
    $tags = mysqli_real_escape_string($db2,$_POST['tags']);
    $category = mysqli_real_escape_string($db2,$_POST['kategori']);
    $arr2 = explode("/",$category);
    $id_category = $arr2[0];
    $deskripsi = mysqli_real_escape_string($db2,$_POST['content']);
    $id_article = mysqli_real_escape_string($db2,$_POST['id_article']);

    echo ' <br> id_artikel:  '.$id_article;
    echo ' <br> judul:  '.$judul;
    echo ' <br> deskripsi: '.$deskripsi;
    echo ' <br> tags: '.$tags;
    echo ' <br> kategori: '.$id_category;

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../artikel.php");

?>