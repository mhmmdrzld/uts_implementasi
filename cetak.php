<?php
require('lib/fpdf/fpdf.php');
include 'koneksi.php';



$pdf = new FPDF('l','mm','A5');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(50,7,'KUCING',0,1,'C');


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'NAMA KUCING',1,0);
$pdf->Cell(50,6,'ASAL KUCING',1,1);

$pdf->SetFont('Arial','',10);

$kucing = mysqli_query($conn, "select * from kucing");
while ($row = mysqli_fetch_array($kucing)){
    $pdf->Cell(50,6,$row['nama_kucing'],1,0);
    $pdf->Cell(50,6,$row['asal_kucing'],1,1);
}

$pdf->Output();
