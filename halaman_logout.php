<?php 
session_start();//memulai session, membaca session
$_SESSION['username'] = "";
$_SESSION['password'] = "";
session_destroy();//menghapus semua session yang pernah disimpan
header("location:halaman_login.php");//membuka halaman login
?>