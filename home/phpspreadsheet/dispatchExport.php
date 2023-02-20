<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["releaseData"])){

  $releaseData= json_decode($_SESSION["releaseData"]);
  $relnumb = array();
  $daterel = array();
  $clientrel = array();
  $weightrel= array();
  $destinerel = array();
  $statusrel= array();
 

  for ($i = 0; $i<count($releaseData);$i++){
    for($j=0;$j<count($releaseData[$i]);$j++){
    }
    array_push($relnumb, $releaseData[$i][0]);
    array_push($daterel,$releaseData[$i][1]);
    array_push($clientrel,$releaseData[$i][2]);
    array_push($weightrel,$releaseData[$i][3]);
    array_push($destinerel,$releaseData[$i][4]);
    array_push($statusrel,$releaseData[$i][5]);
  }

  // var_dump($relnumb);
  // var_dump($daterel);
  // var_dump($clientrel);
  // var_dump($weightrel);
  // var_dump($destinerel);
  // var_dump($statusrel);
  // // var_dump($releaseData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($relnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($daterel as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientrel as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($weightrel as $purp){
    $sheet->setCellValue('D'.$rowCounter4,$purp);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($destinerel as $moisture){
    $sheet->setCellValue('E'.$rowCounter5,$moisture);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($statusrel as $status){
    $sheet->setCellValue('F'.$rowCounter6,$status);
    $rowCounter6++;
  }


    $fileName = "Dispatch Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
  

}
?>