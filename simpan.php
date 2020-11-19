<?php
include 'koneksi.php';

$nama_kucing = $_POST['nama_kucing'];
$asal_kucing = $_POST['asal_kucing'];

$query = mysqli_query($conn,"INSERT INTO kucing VALUES (NULL,'$nama_kucing','$asal_kucing');");
if($query){
    echo '<script language="javascript">alert("Simpan Berhasil !"); document.location="home.php";</script>';
}else{
    echo '<script language="javascript">alert("Simpan Gagal !"); document.location="home.php";</script>';
}