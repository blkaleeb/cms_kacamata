<?php 
include 'conn.php';
session_start();
    
    $id_karyawan = $_POST['id_karyawan'];
    $arr2 = explode("/",$id_karyawan);
    $id_karyawanX = $arr2[0];
    $tgl_penyimpanan = $_POST['tanggal_penyimpanan'];

    $account = $_POST['account'];

    $debit = $_POST['Debit'];

    foreach($account as $key => $account_v) {
        
        $stmt1 = $db2->prepare("INSERT INTO `penyimpanan_bahan_baku` (id_bahan_baku, nik, jumlah_penyimpanan, tanggal_penyimpanan) VALUES(?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $account_vX, $id_karyawanX, $debit_v, $tgl_penyimpanan);
        
        
        $account_v = mysqli_real_escape_string($db2,$account[$key]);
        $arr = explode("/",$account_v);
        $account_vX = $arr[0];

        $debit_v = mysqli_real_escape_string($db2,(double)str_replace(",",".",str_replace(".","",$debit[$key])));
    
        echo "xx ".$account_vX;
        $stmt1->execute();
        $stmt1->close();

        // $sql = "SELECT 'stok_bahan_baku' from `bahan_baku` where 'id_bahan_baku' = '$account_vX'";
        // $d_head = $db2->query($sql);

        // $sumbb = $d_head + $sumbb;
        
        // $stmt3 = $db2->prepare("UPDATE `bahan_baku` set stok_bahan_baku = ? where id_bahan_baku = ?");
        // $stmt3->bind_param("ss", $sumbb, $account_vX);
  

        // $stmt3->execute();
        // $stmt3->close();
    }

    header("location:../penyimpanan_bb.php");


?>