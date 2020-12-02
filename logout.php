<?php
session_start();
session_unset();
session_destroy();

echo json_encode(array(
    'pesan' => ' Berhasil Logout'
), JSON_PRETTY_PRINT);
