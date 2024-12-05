<?php
    /*
    Author: Asher Wayde
    This file is to generate the barcodes linked to an account, and add them to a pdf document


    Barcode Specifications:
        they must fit on a specific kind of page, its a
    */
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ERROR | E_PARSE);
    session_start();

    
    require_once('../../data_src/api/user/read.php');
    
    // this gets the data linked to an account
    $data=readItems();
    
    require '../../data_src/fpdf/fpdf.php';

    // this is the pdf class being initialized
    $pdf = new FPDF();
    $pdf->SetFont('Helvetica','',10);

    // if there is data to print start that
    if(sizeof($data)){

        // this excludes all of the sold items from being printed
        // TODO: allow so that only items of the current event to be printed
        $dataNoSold=[];
        $j=0;
        for($i=0;$i<sizeof($data);$i++){
            if(!$data[$i]['sold']){
                $dataNoSold[$j]=$data[$i];
                $j++;
            }
        }

        // These are the controlling values for printing the barcodes on to the pdf

        // how much it shifts by x when printing a new barcode
        $xshift=60;
        // how much it shifts by y when printing a new row of barcodes
        $yshift=60;
        // how many barcodes are allowed in the page (Not sure if this is descriptive or predictive, but the program needs to know this number)
        $pageLength=15; 
        // how many columns of barcodes are to be printed
        $columns=3; 
        // how many rows of barcodes are to be printed
        $rows=5; 

        // this is the loop that prints the name of the item, if its a donation or not, and the barcode itself
        for($i=0;$i<sizeof($dataNoSold)/$columns;$i++){
            // the inner loop prints out each row individually
            for($j=0;$j<$columns;$j++){
                // if it needs a new page, add one
                if($j+($i*$columns)%$pageLength==0)
                    $pdf->addPage();
                //  this adds a single barcode with name and donation status
                if($j+($i*$columns)<sizeof($dataNoSold)){
                    // this puts the text down, with the formulas for x and y calculation
                    $pdf->text(15+($xshift*$j),15+($yshift*($i%$rows)),strtolower(substr($dataNoSold[$j+($i*$columns)]['title'],0,34)));
                    // this puts the images down with the same formulas
                    $pdf->Image('https://ucs.etowndb.com/data_src/barcode.php?codetype=code39&size=50&text='.$dataNoSold[$j+($i*$columns)]['item_id'].'&print=true',10+($xshift*$j),20+($yshift*($i%$rows)),60,40,'PNG');
                    // if its a donation print the donation flag
                    if($dataNoSold[$j+($i*$columns)]['donation']){
                        $pdf->SetFont('Helvetica','',15);
                        $pdf->text(20+($xshift*$j),57+($yshift*($i%$rows)),'DONATION');
                        $pdf->SetFont('Helvetica','',10);
                    }
                }
            }
        }
        
    }
    // if there are no items to print out, print out that you have no items to print
    else{
        $pdf->cell(10,0,'You have no items to print.',0,1);
    }
    // then send the pdf to the client
    $pdf->Output('I','Barcodes.pdf');
?>