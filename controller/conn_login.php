<?php 
include 'conn.php';
session_start();


$username = mysqli_real_escape_string($db2,$_POST['username']);
$password = mysqli_real_escape_string($db2,$_POST['password']);

echo $password."<br>";
echo $username."<br>";




if($username =="admin" && $password =="Kacamata123"){
	session_start();
	$_SESSION['status_ca'] = "login";
	header("location:../index.php?");
}else{
	session_start();
	$_SESSION['status_ca'] = "xx";
	header("location:../login.php?pesan=error");
		
}


?>