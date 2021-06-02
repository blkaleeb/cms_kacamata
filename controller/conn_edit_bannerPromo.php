<?php 
include 'conn.php';
session_start();

// $target_dir = "../img/thumbnail/";
// $target_file = $target_dir . basename($_FILES["lampiran"]["name"]);
// $name_image1 = basename($_FILES["lampiran"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image

// $check = getimagesize($_FILES["lampiran"]["tmp_name"]);
// if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
// } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
// }

// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
//   // if everything is ok, try to upload file
//   } else {
//     if (move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_file)) {
//       echo "The file ". htmlspecialchars( basename( $_FILES["lampiran"]["name"])). " has been uploaded.";
//     } else {
//       echo "Sorry, there was an error uploading your file.";
//     }
//   }


    $stmt1 = $db2->prepare("UPDATE `bannerPromo` set judul = ?, harga=?, tanggal_berlaku=? , status_banner = ? where id_banner =  ?");
    $stmt1->bind_param("sssss", $judul, $harga, $tanggal_berlaku , $status_banner, $id_banner);
    
    $judul = mysqli_real_escape_string($db2,$_POST['judul1']);
    $harga = mysqli_real_escape_string($db2,$_POST['harga1']);
    $tanggal_berlaku = mysqli_real_escape_string($db2,$_POST['tanggal_berlaku1']);
    $status_banner = mysqli_real_escape_string($db2,$_POST['status_banner1']);
    $id_banner = mysqli_real_escape_string($db2,$_POST['id_banner1']);

    echo ' <br> id_banner:  '.$id_banner;
    echo ' <br> judul:  '.$judul;
    echo ' <br> tanggal_berlaku: '.$tanggal_berlaku;
    echo ' <br> harga: '.$harga;

    $stmt1->execute();
    $stmt1->close();
    
    // header("location:../banner_1.php");

?>