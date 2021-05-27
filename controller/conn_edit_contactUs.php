<?php 
include 'conn.php';
session_start();


    $stmt1 = $db2->prepare("UPDATE `contact_us` set address=?, phone=?, email=?, address_google=?");
    $stmt1->bind_param("ssss", $alamat, $no_hp, $email, $location);
    
    $alamat = mysqli_real_escape_string($db2,$_POST['alamat']);
    $no_hp = mysqli_real_escape_string($db2,$_POST['no_hp']);
    $email = mysqli_real_escape_string($db2,$_POST['email']);
    $location = mysqli_real_escape_string($db2,$_POST['location']);

    echo ' <br> alamat: '.$alamat ;
    echo ' <br> no_hp: '.$no_hp ;
    echo ' <br> email: '.$email ;
    echo ' <br> location: '.$location ;

    $stmt1->execute();
    $stmt1->close();

    header("location:../contact_us.php");



	



?>