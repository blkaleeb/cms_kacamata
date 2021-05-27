<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `detail_pesanan` where id_pesanan = ? ");
    $stmt3->bind_param("s",  $idAcc);
    
    if (isset($_GET['id_pesanan'])) {
        $idAcc=$_GET['id_pesanan'];
    }else{
    $idAcc = mysqli_real_escape_string($db2,$_POST['nik']);
    }
    echo "cc = ".$idAcc;

    $stmt3->execute();
    $stmt3->close();

    $stmt4 = $db2->prepare("DELETE from `pesanan` where id_pesanan = ? ");
    $stmt4->bind_param("s",  $idAcc);
    

    $stmt4->execute();
    $stmt4->close();

    header("location:../detail_pesanan.php?");





?>