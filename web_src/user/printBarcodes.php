<?php
    /*
    Barcode Specifications:
        they must fit on a specific kind of page, its a
    */
    session_start();
    require_once "../../data_src/api/user/read.php";
    $data=readItems();
    require "../../data_src/fpdf/fpdf.php";
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',14);
    if(sizeof($data)){
        $dataNoSold=[];
        $j=0;
        for($i=0;$i<sizeof($data);$i++){
            if(!$data[$i]['sold']){
                $dataNoSold[$j]=$data[$i];
                $j++;
            }
        }
        for($i=0;$i<sizeof($dataNoSold);$i++){
            $pdf->text(20,15+(60*$i),strtolower(substr($dataNoSold[$i]['title'],0,34)));
            $pdf->Image('http://localhost/ucswebsite/data_src/barcode.php?codetype=code39&size=50&text='.$dataNoSold[$i]['item_id'].'&print=true',10,20+(60*$i),80,40,'PNG');
            if($dataNoSold[$i]['donation'])
                $pdf->text(35,57+(60*$i),'DONATION');
        }
    }
    else{
        $pdf->cell(10,0,'You have no items to print.',0,1);
    }
    $pdf->Output(name:'Barcodes.pdf');
?>