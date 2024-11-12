<?php

require '../fpdf/fpdf.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica','',14);


$pdf->cell(0,10,'You are going to Brazil!',0,1);

$pdf->Image('http://localhost/ucswebsite/data_src/barcode.php?codetype=code39&size=50&text=1001&print=true',0,20,100,100,'PNG'); 


$pdf->Output('I');

?>
