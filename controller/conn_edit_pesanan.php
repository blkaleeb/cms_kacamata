<?php 
include 'conn.php';
session_start();

$stmt3 = $db2->prepare("DELETE from `detail_pesanan` where id_pesanan = ? ");
$stmt3->bind_param("s",  $idAcc);

$idAcc = mysqli_real_escape_string($db2,$_POST['idAwal']);
echo "cc = ".$idAcc;

$stmt3->execute();
$stmt3->close();

$stmt4 = $db2->prepare("DELETE from `pesanan` where id_pesanan = ? ");
$stmt4->bind_param("s",  $idAcc);


$stmt4->execute();
$stmt4->close();

    
    $stmt1 = $db2->prepare("INSERT INTO `pesanan` (id_pesanan, id_konsumen, tanggal_pesan, batas_waktu)
                            VALUES(?, ?, ?, ?)");
    $stmt1->bind_param("ssss", $idPesanan, $idKonsumenX, $tanggalMasuk, $batasWaktu);
    

    $idPesanan = mysqli_real_escape_string($db2,$_POST['idPesanan']);
    $idKonsumen = mysqli_real_escape_string($db2,$_POST['idKonsumen']);
    $arr2 = explode("/",$idKonsumen);
    $idKonsumenX = $arr2[0];
    $tanggalMasuk = mysqli_real_escape_string($db2,$_POST['tanggalMasuk']);
    $batasWaktu = mysqli_real_escape_string($db2,$_POST['batasWaktu']);


    $stmt1->execute();
    $stmt1->close();
    


    $account = $_POST['account'];

    $debit = $_POST['Debit'];
    print_r($_POST['account']);

    foreach($account as $key => $account_v) {
        
        $stmt2 = $db2->prepare("INSERT INTO `detail_pesanan` (id_pesanan, id_barang, jumlah_barang) VALUES(?, ?, ?)");
        $stmt2->bind_param("sss", $idPesanan, $account_vX, $debit_v);
        
        
        $account_v = mysqli_real_escape_string($db2,$account[$key]);
        $arr = explode("/",$account_v);
        $account_vX = $arr[0];

        $debit_v = mysqli_real_escape_string($db2,(double)str_replace(",",".",str_replace(".","",$debit[$key])));
        $Credit_v = mysqli_real_escape_string($db2,(double)str_replace(",",".",str_replace(".","",$Credit[$key])));
    
        echo "xx ".$account_vX;
        $stmt2->execute();
        $stmt2->close();
    }

    header("location:../detail_pesanan.php");



	



?>