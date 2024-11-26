<?php
    /*
    Barcode Specifications:
        they must fit on a specific kind of page, its a
    */
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ERROR | E_PARSE);
    session_start();
    require_once('../../data_src/api/user/read.php');
    
    $data=readItems();
    //print_r($data);
    
    require '../../data_src/fpdf/fpdf.php';
    $pdf = new FPDF();
    //$pdf->AddPage();
    
    $pdf->SetFont('Helvetica','',10);
    if(sizeof($data)){
        $dataNoSold=[];
        $j=0;
        for($i=0;$i<sizeof($data);$i++){
            if(!$data[$i]['sold']){
                $dataNoSold[$j]=$data[$i];
                $j++;
            }
        }
        $xshift=60;
        $yshift=60;
        $pageLength=15;
        $columns=3;
        $rows=5;
        for($i=0;$i<sizeof($dataNoSold)/$columns;$i++){
            for($j=0;$j<$columns;$j++){
                if($j+($i*$columns)%$pageLength==0)
                    $pdf->addPage();
                if($j+($i*$columns)<sizeof($dataNoSold)){
                    $pdf->text(15+($xshift*$j),15+($yshift*($i%$rows)),strtolower(substr($dataNoSold[$j+($i*$columns)]['title'],0,34)));
                    $pdf->Image('https://ucs.etowndb.com/data_src/barcode.php?codetype=code39&size=50&text='.$dataNoSold[$j+($i*$columns)]['item_id'].'&print=true',10+($xshift*$j),20+($yshift*($i%$rows)),60,40,'PNG');
                    if($dataNoSold[$j+($i*$columns)]['donation']){
                        $pdf->SetFont('Helvetica','',15);
                        $pdf->text(20+($xshift*$j),57+($yshift*($i%$rows)),'DONATION');
                        $pdf->SetFont('Helvetica','',10);
                    }
                }
            }
        }
        
    }
    else{
        $pdf->cell(10,0,'You have no items to print.',0,1);
    }
    $pdf->Output('I','Barcodes.pdf');
?>