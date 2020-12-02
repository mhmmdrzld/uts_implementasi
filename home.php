<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    echo '<script language="javascript">alert("Anda Belum Login !"); document.location="index.php";</script>';
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include 'css.php'; ?>
    <?php include 'script.php'; ?>
    

    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-md-6">
                <a class="btn btn-primary" href="#" role="button" id="tambah">Tambah</a>
                <a class="btn btn-primary" href="#" role="button" id="cetak">Cetak</a>
                <a class="btn btn-primary" href="#" role="button" id="logout">Log Out</a>
            </div>
            <br>
        </div>
        <div class="row p-3">
            <div class="col-md-6">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Nama Kucing</th>
                            <th>Asal Kucing</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'modals.php' ?>
    <script>
        $(document).ready(function() {

            var modal = $('#exampleModal');
            var modal2 = $('#modalsimpan');
            var i = 1;
            var table = $('#table_id').DataTable({
                "language": {
                    "processing": "Sedang Menampilkan Data"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "get_kucing.php",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 50],
                    [5, 10, 50]
                ],
                "columns": [{
                        "data": "nama_kucing",
                    },
                    {
                        "data": "asal_kucing"
                    },
                    {
                        "data": "id",
                        render: function(data, type, row) {
                            return ' <a class="btn btn-primary" href="#" role="button" id="edit">Edit</a> |   <a class="btn btn-primary" href="#" role="button" id="hapus">Hapus</a>';
                        }
                    },
                ]
            });

            $("#tambah").on("click", function() {
                modal2.modal('show');
                modal2.find('.modal-title').text('Tambah Data Kucing');
                modal2.find('#nama-kucing').val('');
                modal2.find('#asal-kucing').val('');
            });

            $('#btnsimpan').on('click', function() {
                var namakucing = modal2.find('#nama-kucing').val();
                var asalkucing = modal2.find('#asal-kucing').val();
                console.log(namakucing + '/' + asalkucing);

                if (namakucing == '' && asalkucing == '') {
                    alert("Inputan Tidak Boleh Kosong");
                } else if (namakucing == '' || asalkucing == '') {
                    alert("Inputan Tidak Boleh Kosong");
                } else {
                    $.ajax({
                        url: 'simpan.php?aksi=simpan',
                        method: 'POST',
                        data: $('#formsimpan').serialize(),
                        success: function(res) {
                            var datas = JSON.parse(res);
                            table.ajax.reload(null, false);
                            modal2.modal('hide');
                            alert(datas.pesan);


                        }
                    });
                }

            });

            $("#table_id tbody").on("click", "#edit", function() {
                var data = table.row($(this).parents('tr')).data();
                console.log(data);
                modal.modal('show');
                modal.find('.modal-title').text('Edit Data Kucing');
                modal.find('#id').val(data.id);
                modal.find('#nama-kucing').val(data.nama_kucing);
                modal.find('#asal-kucing').val(data.asal_kucing);
            });

            $('#button').on('click', function() {
                var namakucing = modal.find('#nama-kucing').val();
                var asalkucing = modal.find('#asal-kucing').val();

                if (namakucing == '' && asalkucing == '') {
                    alert("Inputan Tidak Boleh Kosong");
                } else if (namakucing == '' || asalkucing == '') {
                    alert("Inputan Tidak Boleh Kosong");
                } else {
                    $.ajax({
                        url: 'simpan.php?aksi=edit',
                        method: 'POST',
                        data: $('#forms').serialize(),
                        success: function(res) {
                            var datas = JSON.parse(res);
                            table.ajax.reload(null, false);
                            modal.find('#nama-kucing').val('');
                            modal.find('#asal-kucing').val('');
                            modal.modal('hide');
                            alert(datas.pesan);


                        }
                    });
                }
            });

            $("#table_id tbody").on("click", "#hapus", function() {
                var data = table.row($(this).parents('tr')).data();
                console.log(data);
                var confr = confirm("Apakah Anda Yakin Menghapus data ?");
                if (confr == true) {
                    $.ajax({
                        url: 'hapus.php?id=' + data.id,
                        method: 'POST',
                        success: function(res) {
                            var datas = JSON.parse(res);
                            table.ajax.reload(null, false);
                            alert(datas.pesan);


                        }
                    });
                }
            });

            $('#cetak').on('click', function() {
                window.open('cetak.php', '_blank', 'toolbar=no, menubar=0, status=0, copyhistory=0, scrollbars=yes, resizable=1, location=0');
            });

            $("#logout").on("click", function() {
                var confr = confirm("Apakah Anda Yakin Untuk Keluar ?");
                if (confr == true) {
                    $.ajax({
                        url: 'logout.php',
                        method: 'POST',
                        success: function(res) {
                            var datas = JSON.parse(res);
                            alert(datas.pesan);
                            window.location = "index.php";
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>