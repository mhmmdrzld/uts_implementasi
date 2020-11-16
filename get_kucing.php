<?php
include "koneksi.php";

$search = $_POST['search']['value']; 
$limit = $_POST['length'];
$start = $_POST['start'];

$sql = mysqli_query($conn, "SELECT nama_kucing FROM kucing");
$sql_count = mysqli_num_rows($sql);

$query = "SELECT * FROM kucing WHERE (nama_kucing LIKE '%".$search."%' OR asal_kucing LIKE '%".$search."%' )";
$order_index = $_POST['order'][0]['column']; 
$order_field = $_POST['columns'][$order_index]['data']; 
$order_ascdesc = $_POST['order'][0]['dir']; 
$order = " ORDER BY ".$order_field." ".$order_ascdesc;

$sql_data = mysqli_query($conn, $query.$order." LIMIT ".$limit." OFFSET ".$start); 
$sql_filter = mysqli_query($conn, $query); 
$sql_filter_count = mysqli_num_rows($sql_filter); 

$data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC); 
$callback = array(
    'draw'=>$_POST['draw'],
    'recordsTotal'=>$sql_count,
    'recordsFiltered'=>$sql_filter_count,
    'data'=>$data
);

header('Content-Type: application/json');
echo json_encode($callback);
