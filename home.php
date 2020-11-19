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
                        render: function(data, type, row) {
                            return '  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-status="Edit">Edit</button>|   <a class="btn btn-primary" href="#" role="button" id="hapus">Hapus</a>';
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

            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget).data('status')
                var modal = $(this)
                modal.find('.modal-title').text(button + ' Data Kucing')
                modal.find('.btn-primary').attr('id', button)

                var data = $('#forms').serialize();
                $("#Tambah").on("click", function() {
                // alert('gerrr')
                $.ajax({
                    url: 'simpan.php',
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        // alert(data);
                    }
                });
            });
            })


        });
    </script>

</body>

</html>