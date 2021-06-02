<?php 
include 'conn.php';
session_start();

$target_dir = "../img/thumbnail/";
$target_file = $target_dir . basename($_FILES["lampiran"]["name"]);
$name_image1 = basename($_FILES["lampiran"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["lampiran"]["tmp_name"]);
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["lampiran"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }


    $stmt1 = $db2->prepare("UPDATE `artikel` set judul = ?, tags=?, id_kategori=?, deskripsi=?, thumbnail=? where id_article = ?");
    $stmt1->bind_param("ssssss", $judul, $tags, $id_category, $deskripsi, $name_image1 , $id_article);
    
    $judul = mysqli_real_escape_string($db2,$_POST['judul']);
    $tags = mysqli_real_escape_string($db2,$_POST['tags']);
    $category = mysqli_real_escape_string($db2,$_POST['kategori']);
    $arr2 = explode("/",$category);
    $id_category = $arr2[0];
    $deskripsi = mysqli_real_escape_string($db2,$_POST['content']);
    $id_article = mysqli_real_escape_string($db2,$_POST['id_article']);

    echo ' <br> id_artikel:  '.$id_article;
    echo ' <br> judul:  '.$judul;
    echo ' <br> deskripsi: '.$deskripsi;
    echo ' <br> tags: '.$tags;
    echo ' <br> kategori: '.$id_category;
    echo ' <br> gambar: '.$name_image1;

    $stmt1->execute();
    $stmt1->close();
    
    header("location:../artikel.php");

?>