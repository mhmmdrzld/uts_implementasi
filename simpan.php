<?php
include 'koneksi.php';

if ($_GET['aksi'] == 'edit') {
    $aksi = 'Edit';
    $id = $_POST['id'];
    $nama_kucing = $_POST['nama_kucing'];
    $asal_kucing = $_POST['asal_kucing'];

    $query = mysqli_query($conn, "UPDATE kucing set nama_kucing = '$nama_kucing',asal_kucing = '$asal_kucing' WHERE id ='$id';");
} else {
    $aksi = 'Tambah';
    $nama_kucing = $_POST['nama_kucing'];
    $asal_kucing = $_POST['asal_kucing'];

    $query = mysqli_query($conn, "INSERT INTO kucing VALUES (NULL,'$nama_kucing','$asal_kucing');");
}

if ($query) {
    echo json_encode(array(
        'pesan' => $aksi . ' Berhasil',
        'nama_kucing' => $nama_kucing,
        'asal_kucing' => $asal_kucing
    ), JSON_PRETTY_PRINT);
} else {
    echo json_encode(array(
        'pesan' =>  $aksi . ' Gagal',
        'nama_kucing' => $nama_kucing,
        'asal_kucing' => $asal_kucing
    ), JSON_PRETTY_PRINT);
}
