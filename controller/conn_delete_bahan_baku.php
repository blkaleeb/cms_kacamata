<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `bahan_baku` where id_bahan_baku = ? ");
    $stmt3->bind_param("s",  $idAcc);
    
    $idAcc = mysqli_real_escape_string($db2,$_POST['nik']);
    echo "cc = ".$idAcc;

    $stmt3->execute();
    $stmt3->close();
    header("location:../bahan_baku.php?");





?>