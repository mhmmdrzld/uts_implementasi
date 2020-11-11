<?php
    include 'koneksi.php';
    if(!isset($_POST['sumbit'])){
        echo 'Login Berhasil';
    }else{
        echo 'Login Gagal';
    }
?>