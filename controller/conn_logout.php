<?php 
include 'conn.php';
session_start();

$_SESSION['status_ca'] = "logout";
$_SESSION['username'] = "";

header("location:../login.php?");


?>