<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["goodsreceivedData"])){

  $previousgrnData= json_decode($_SESSION["goodsreceivedData"]);
  $numbgrn = array();
  $dategrn = array();
  $clientgrn = array();
  $purposegrn = array();
  $moisturegrn= array();
  $weightgrn= array();

  for ($i = 0; $i<count($previousgrnData);$i++){
    for($j=0;$j<count($previousgrnData[$i]);$j++){
    }
    array_push($numbgrn, $previousgrnData[$i][0]);
    array_push($dategrn,$previousgrnData[$i][1]);
    array_push($clientgrn,$previousgrnData[$i][2]);
    array_push($purposegrn,$previousgrnData[$i][3]);
    array_push($moisturegrn,$previousgrnData[$i][4]);
    array_push($weightgrn,$previousgrnData[$i][5]);
  }

  // var_dump($numbgrn);
  // var_dump($dategrn);
  // var_dump($clientgrn);
  // var_dump($purposegrn);
  // var_dump($moisturegrn);
  // var_dump($weightgrn);
  // var_dump($previousgrnData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($numbgrn as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($dategrn as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientgrn as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($purposegrn as $purp){
    $sheet->setCellValue('D'.$rowCounter4,$purp);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($moisturegrn as $moisture){
    $sheet->setCellValue('E'.$rowCounter5,$moisture);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($weightgrn as $weight){
    $sheet->setCellValue('F'.$rowCounter6,$weight);
    $rowCounter6++;
  }


    $fileName = "Previous GRNs".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);

}
?>