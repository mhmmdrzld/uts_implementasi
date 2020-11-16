<?php
include 'koneksi.php';

$email = $_POST['email'];
$password = md5($_POST['password']);

$login = mysqli_query($conn, "select * from user where email='$email' and password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";
    echo '<script language="javascript">alert("Login Berhasil !"); document.location="home.php";</script>';
} else {
    echo '<script language="javascript">alert("Login Gagal !"); document.location="index.php";</script>';
}
