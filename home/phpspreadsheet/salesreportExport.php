<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["salesData"])){
  $salesData= json_decode($_SESSION["salesData"]);
  $salnumb = array();
  $datesal = array();
  $clientsal = array();
  $category= array();
  $currency = array();
  $salvalue= array();
 
  for ($i = 0; $i<count($salesData);$i++){
    for($j=0;$j<count($salesData[$i]);$j++){
    }
    array_push($salnumb, $salesData[$i][0]);
    array_push($datesal,$salesData[$i][1]);
    array_push($clientsal,$salesData[$i][2]);
    array_push($category,$salesData[$i][3]);
    array_push($currency,$salesData[$i][4]);
    array_push($salvalue,$salesData[$i][5]);
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
  foreach($salnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datesal as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientsal as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($category as $cat){
    $sheet->setCellValue('D'.$rowCounter4,$cat);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($currency as $curr){
    $sheet->setCellValue('E'.$rowCounter5,$curr);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($salvalue as $net){
    $sheet->setCellValue('F'.$rowCounter6,$net);
    $rowCounter6++;
  }


    $fileName = "Sales Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
}
?>