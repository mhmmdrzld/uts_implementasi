<?php
include 'koneksi.php';

$nama_kucing = $_POST['nama_kucing'];
$asal_kucing = $_POST['asal_kucing'];

$query = mysqli_query($conn, "INSERT INTO kucing VALUES (NULL,'$nama_kucing','$asal_kucing');");
if ($query) {
    echo json_encode(array('pesan' => 'Simpan Berhasil','status'=>1),JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('pesan' => 'Simpan Berhasil'),JSON_PRETTY_PRINT);
    // echo '<script language="javascript">alert("Simpan Gagal !"); document.location="home.php";</script>';
}
