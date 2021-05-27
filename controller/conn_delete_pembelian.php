<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `pembelian` where id_pembelian = ? ");
    $stmt3->bind_param("s",  $idAcc);
    
    $idAcc = mysqli_real_escape_string($db2,$_POST['idAwal']);
    echo "cc = ".$idAcc;

    $stmt3->execute();
    $stmt3->close();

    $stmt3 = $db2->prepare("DELETE from `detail_pembelian` where id_pembelian = ? ");
    $stmt3->bind_param("s",  $idAcc);
    
    $idAcc = mysqli_real_escape_string($db2,$_POST['idAwal']);
    echo "cc = ".$idAcc;

    $stmt3->execute();
    $stmt3->close();

    header("location:../report_pembelian_bb.php?");

?>