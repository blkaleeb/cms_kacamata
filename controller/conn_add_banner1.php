<?php 
include 'conn.php';
session_start();
    
    $stmt1 = $db2->prepare("INSERT INTO `banner1` (judul, text_discount, text3)
                            VALUES(?, ?, ?)");
    $stmt1->bind_param("sss", $judul, $text_discount, $text3);
    
    $judul = mysqli_real_escape_string($db2,$_POST['judul']);
    $text_discount = mysqli_real_escape_string($db2,$_POST['textDiscount']);
    $text3 = mysqli_real_escape_string($db2,$_POST['text3']);

    echo '<br> judul: '.$judul ;
    echo '<br> text_discount: '.$text_discount ;
    echo '<br> text3: '.$text3 ;

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../banner_1.php");



	



?>