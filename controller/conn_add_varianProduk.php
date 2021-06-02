<?php 
include 'conn.php';
session_start();

    $target_dir = "../img/varian/";
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
	echo $name_image1."<br>";
    
    $stmt1 = $db2->prepare("INSERT INTO `varian` (id_produk, gambar) VALUES(?, ?)");
    $stmt1->bind_param("ss", $id_produk, $name_image1 );
    
    
    $id_produk = mysqli_real_escape_string($db2,$_POST['id_produk']);
    echo 'id_produk: '.$id_produk;
    echo 'name_image1: '.$name_image1;


    $stmt1->execute();
    printf("Error: %s.\n", $stmt1->error);
    $stmt1->close();
    
    header("location:../varian_produk.php?id_produk=$id_produk");



?>