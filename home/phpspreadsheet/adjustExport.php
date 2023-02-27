<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["adjustData"])){

  $adjustData= json_decode($_SESSION["adjustData"]);
  $adjustnumb = array();
  $dateadjust = array();
  $clientadjust = array();
  $affected= array();
  $added= array();
  $reduced = array();
  $comment= array();
  
 

  for ($i = 0; $i<count($adjustData);$i++){
    for($j=0;$j<count($adjustData[$i]);$j++){
    }
    array_push($adjustnumb, $adjustData[$i][0]);
    array_push($dateadjust,$adjustData[$i][1]);
    array_push($clientadjust,$adjustData[$i][2]);
    array_push($affected,$adjustData[$i][3]);
    array_push($added,$adjustData[$i][4]);
    array_push($reduced,$adjustData[$i][5]);
    array_push($comment,$adjustData[$i][6]);
  }

  

  // var_dump($relnumb);
  // var_dump($daterel);
  // var_dump($clientrel);
  // var_dump($weightrel);
  // var_dump($destinerel);
  // var_dump($statusrel);
  // // var_dump($adjustData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($adjustnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($dateadjust as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientadjust as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($affected as $aff){
    $sheet->setCellValue('D'.$rowCounter4,$aff);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($added as $add){
    $sheet->setCellValue('E'.$rowCounter5,$add);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($reduced as $red){
    $sheet->setCellValue('F'.$rowCounter6,$red);
    $rowCounter6++;
  }
  $rowCounter7 = 1;
  foreach($comment as $comm){
    $sheet->setCellValue('G'.$rowCounter7,$comm);
    $rowCounter7++;
  }


    $fileName = "adjustments Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
  

}
?>