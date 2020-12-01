<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include 'css.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <?php include 'script.php'; ?>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

    <title>Home</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row p-3">
            <div class=" col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-status="Tambah">Tambah</button>
            </div>
            <br>
        </div>
        <div class="row p-3">
            <div class="col-md-6">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
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
                        render: function(data, type, row) {
                            return data;
                        }
                    },
                    {
                        "data": "nama_kucing",
                    },
                    {
                        "data": "asal_kucing"
                    },
                    {
                        "data": "id",
                        render: function(data) {
                            return ' <a class="btn btn-primary" href="#" role="button" id="edit">Edit</a> |   <a class="btn btn-primary" href="#" role="button" id="hapus">Hapus</a>';
                        }
                    },
                ]
            });

            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            modal.on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget).data('status')
                var modal = $(this)
                modal.find('.modal-title').text(button + ' Data Kucing')
                modal.find('.btn-primary').attr('id', button)


                $("#Tambah").on("click", function() {
                    var dataform = $('#forms').serialize();
                    $('#nama-kucing').empty('');
                    $('#asal-kucing').empty('');
                    // alert('gerrr')
                    $.ajax({
                        url: 'simpan.php',
                        method: 'POST',
                        data: dataform,
                        success: function(data) {
                            $('#exampleModal').modal('hide')
                            alert(data['pesan']);

                        }
                    });
                });
            });



            $("#table_id tbody").on("click", "#edit", function() {
                var data = table.row($(this).parents('tr')).data();
                console.log(data);
                modal.modal('show');
                modal.find('.modal-title').text('Edit Data Kucing');
                modal.find('#id').val(data.id);
                modal.find('#nama-kucing').val(data.nama_kucing);
                modal.find('#asal-kucing').val(data.asal_kucing);
                // modal.find('.btn-primary').attr('id', 'prosesedit');
            });

            $('#button').on('click', function() {
                $.ajax({
                    url: 'simpan.php?aksi=edit',
                    method: 'POST',
                    data: $('#forms').serialize(),
                    success: function(res) {
                        var datas = JSON.parse(res);
                        modal.modal('hide')
                        alert(datas.pesan);

                    }
                });
            });

        });
    </script>

</body>

</html>