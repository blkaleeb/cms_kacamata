<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `banner1` where id_banner = ? ");
    $stmt3->bind_param("s",  $id_banner);

    $id_banner = $_GET['id_banner'];
    echo "cc = ".$id_banner;

    $stmt3->execute();
    $stmt3->close();

    header("location:../banner_1.php?");





?>