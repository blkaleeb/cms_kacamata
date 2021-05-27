<?php 
include 'conn.php';

    $stmt3 = $db2->prepare("DELETE from `master_data` where id_master_data = ? ");
    $stmt3->bind_param("s",  $idAcc);
    
    if (isset($_GET['id_master_data'])) {
        $idAcc=$_GET['id_master_data'];
    }else{
    $idAcc = mysqli_real_escape_string($db2,$_POST['nik']);
    }
    echo "cc = ".$idAcc;

    $stmt3->execute();
    $stmt3->close();



    header("location:../master_data.php?");





?>