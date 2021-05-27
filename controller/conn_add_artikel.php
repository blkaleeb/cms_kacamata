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
	// 	echo "File is an image - " . $check["mime"] . ".";
	// 	$uploadOk = 1;
	// } else {
	// 	echo "File is not an image.";
	// 	$uploadOk = 0;
	// }

	// if ($uploadOk == 0) {
	// 	echo "Sorry, your file was not uploaded.";
	//   // if everything is ok, try to upload file
	//   } else {
	// 	if (move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_file)) {
	// 	  echo "The file ". htmlspecialchars( basename( $_FILES["lampiran"]["name"])). " has been uploaded.";
	// 	} else {
	// 	  echo "Sorry, there was an error uploading your file.";
	// 	}
	//   }
	// echo $name_image1."<br>";

    // if ($_FILES['file']['name']) {
    //     if (!$_FILES['file']['error']) {
    //       $name = md5(rand(100, 200));
    //       $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //       $filename = $name.
    //       '.'.$ext;
    //       $destination = '/img/thumbnail/'.$filename; //change this directory
    //       $location = $_FILES["file"]["tmp_name"];
    //       move_uploaded_file($location, $destination);
    //       echo '/img/thumbnail/'.$filename; //change this URL
    //     } else {
    //       echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    //     }
    //   }
    
    $stmt1 = $db2->prepare("INSERT INTO `artikel` (judul, deskripsi, tags, id_kategori, tanggal_posting) VALUES(?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $judul, $deskripsi, $tags, $id_category, $tanggal_posting);
    
    
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

    $stmt1->execute();
    printf("Error: %s.\n", $stmt1->error);
    $stmt1->close();
    
    header("location:../artikel.php");



?>