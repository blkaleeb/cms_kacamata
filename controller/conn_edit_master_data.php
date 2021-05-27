<?php 
include 'conn.php';
session_start();

$stmt3 = $db2->prepare("DELETE from `master_data` where id_master_data = ? ");
$stmt3->bind_param("s",  $idAcc);

$idAcc = mysqli_real_escape_string($db2,$_POST['idAwal']);
echo "cc = ".$idAcc;

$stmt3->execute();
$stmt3->close();


    
$idPesanan = mysqli_real_escape_string($db2,$_POST['idPesanan']);
$idKonsumen = mysqli_real_escape_string($db2,$_POST['idKonsumen']);
$arr2 = explode("/",$idKonsumen);
$idKonsumenX = $arr2[0];
$tanggalMasuk = mysqli_real_escape_string($db2,$_POST['tanggalMasuk']);
$batasWaktu = mysqli_real_escape_string($db2,$_POST['batasWaktu']);



$account = $_POST['account'];

$debit = $_POST['Debit'];
print_r($_POST['account']);

foreach($account as $key => $account_v) {
    
    $stmt2 = $db2->prepare("INSERT INTO `master_data` (id_master_data, id_barang, id_bahan_baku, jumlah_kebutuhan) VALUES(?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $idPesanan, $idKonsumenX, $account_vX, $debit_v);
    
    
    $account_v = mysqli_real_escape_string($db2,$account[$key]);
    $arr = explode("/",$account_v);
    $account_vX = $arr[0];

    $debit_v = mysqli_real_escape_string($db2,(double)str_replace(",",".",str_replace(".","",$debit[$key])));


    echo "xx ".$account_vX;
    $stmt2->execute();
    $stmt2->close();
}

header("location:../master_barang.php");



	



?>