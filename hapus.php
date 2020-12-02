<?php
include 'koneksi.php';

$id = $_GET['id'];
$aksi = 'Hapus';
$query = mysqli_query($conn, "DELETE FROM kucing WHERE id ='$id';");

if ($query) {
    echo json_encode(array(
        'pesan' => $aksi . ' Berhasil'
    ), JSON_PRETTY_PRINT);
} else {
    echo json_encode(array(
        'pesan' =>  $aksi . ' Gagal'
    ), JSON_PRETTY_PRINT);
}
