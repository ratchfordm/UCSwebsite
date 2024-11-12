<?php
    session_start();
    require_once "../../data_src/api/user/read.php";
    $data=readItems();
    require "../../data_src/fpdf/fpdf.php";
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',14);
    if(sizeof($data)){
        //$pdf->cell(10,0,$data[0]['title'],0,1);
        $pdf->Image('http://localhost/ucswebsite/data_src/barcode.php?codetype=code39&size=50&text='.$data[0]['item_id'].'&print=true',10,20,80,40,'PNG');
        for($i=1;$i<sizeof($data);$i++){
            //$pdf->cell(10,0,$data[$i]['title'],0,1);
            $pdf->write(10,$data[$i]['title']);
            $pdf->Image('http://localhost/ucswebsite/data_src/barcode.php?codetype=code39&size=50&text='.$data[$i]['item_id'].'&print=true',10,20+(60*$i),80,40,'PNG');
            //$pdf->cell(80,80);
        }
    }
    else{
        $pdf->cell(10,0,'You have no items to print.',0,1);
    }
    $pdf->Output();
?>