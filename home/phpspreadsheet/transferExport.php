<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["transferData"])){
  $transferData= json_decode($_SESSION["transferData"]);
  $transnumb = array();
  $datetrans = array();
  $from = array();
  $to= array();
  $totalqty = array();
  $comment= array();
 
  for ($i = 0; $i<count($transferData);$i++){
    for($j=0;$j<count($transferData[$i]);$j++){
    }
    array_push($transnumb, $transferData[$i][0]);
    array_push($datetrans,$transferData[$i][1]);
    array_push($from,$transferData[$i][2]);
    array_push($to,$transferData[$i][3]);
    array_push($totalqty,$transferData[$i][4]);
    array_push($comment,$transferData[$i][5]);
  }

 

  // var_dump($salnumb);
  // var_dump($datesal);
  // var_dump($clientsal);
  // var_dump($category);
  // var_dump($currency);
  // var_dump($salvalue);
  // // var_dump($releaseData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($transnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datetrans as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($from as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($to as $client2){
    $sheet->setCellValue('D'.$rowCounter4,$client2);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($totalqty as $qty){
    $sheet->setCellValue('E'.$rowCounter5,$qty);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($comment as $com){
    $sheet->setCellValue('F'.$rowCounter6,$com);
    $rowCounter6++;
  }


    $fileName = "Transfer Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
}
?>