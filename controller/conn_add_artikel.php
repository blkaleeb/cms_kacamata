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
    
    $stmt1 = $db2->prepare("INSERT INTO `artikel` (judul, deskripsi, tags, id_kategori, tanggal_posting, thumbnail) VALUES(?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param("ssssss", $judul, $deskripsi, $tags, $id_category, $tanggal_posting, $name_image1);
    
    
    $judul = mysqli_real_escape_string($db2,$_POST['judul']);
    $deskripsi = mysqli_real_escape_string($db2,$_POST['content']);
    $tags = mysqli_real_escape_string($db2,$_POST['tags']);
    $category = mysqli_real_escape_string($db2,$_POST['kategori']);
    $arr2 = explode("/",$category);
    $id_category = $arr2[0];
    $tanggal_posting = mysqli_real_escape_string($db2,$_POST['tglPosting']);

    echo 'judul: '.$judul;
    echo 'deskripsi: '.$deskripsi;
    echo 'tags: '.$tags;
    echo 'tanggal_posting: '.$tanggal_posting;
    echo 'gambar: '.$name_image1;

    $stmt1->execute();
    printf("Error: %s.\n", $stmt1->error);
    $stmt1->close();
    
    header("location:../artikel.php");



?>