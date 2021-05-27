<?php 
include 'conn.php';
session_start();

    $idAcc = mysqli_real_escape_string($db2,$_POST['idAwal']);
    
    $stmt3 = $db2->prepare("DELETE from `detail_pembelian` where id_pembelian = ? ");
    $stmt3->bind_param("s",  $idAcc);


    $stmt3->execute();
    $stmt3->close();

    $stmt4 = $db2->prepare("DELETE from `pembelian` where id_pembelian = ? ");
    $stmt4->bind_param("s",  $idAcc);


    $stmt4->execute();
    $stmt4->close();

    
    $stmt1 = $db2->prepare("INSERT INTO `pembelian` (id_pembelian, nik, id_supplier, tanggal_pembelian, tanggal_pengiriman)
    VALUES(?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $id_pembelian, $id_karyawanX, $id_supplierX, $tgl_pembelian, $tgl_pengiriman);


    $id_pembelian = mysqli_real_escape_string($db2,$_POST['id_pembelian']);
    $id_karyawan = mysqli_real_escape_string($db2,$_POST['id_karyawan']);
    $arr2 = explode("/",$id_karyawan);
    $id_karyawanX = $arr2[0];
    $id_supplier = mysqli_real_escape_string($db2,$_POST['id_supplier']);
    $arr3 = explode("/",$id_supplier);
    $id_supplierX = $arr3[0];
    $tgl_pembelian = mysqli_real_escape_string($db2,$_POST['tgl_pembelian']);
    $tgl_pengiriman = mysqli_real_escape_string($db2,$_POST['tgl_pengiriman']);


    $stmt1->execute();
    $stmt1->close();
    


    $account = $_POST['account'];

    $debit = $_POST['Debit'];

    foreach($account as $key => $account_v) {
        
        $stmt2 = $db2->prepare("INSERT INTO `detail_pembelian` (id_pembelian, id_bahan_baku, jumlah_pembelian) VALUES(?, ?, ?)");
        $stmt2->bind_param("sss", $id_pembelian, $account_vX, $debit_v);
        
        
        $account_v = mysqli_real_escape_string($db2,$account[$key]);
        $arr = explode("/",$account_v);
        $account_vX = $arr[0];

        $debit_v = mysqli_real_escape_string($db2,(double)str_replace(",",".",str_replace(".","",$debit[$key])));
    
        echo "xx ".$account_vX;
        $stmt2->execute();
        $stmt2->close();
    }

    header("location:../report_pembelian_bb.php");



	



?>