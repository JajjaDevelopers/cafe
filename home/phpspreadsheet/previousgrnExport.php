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

  var_dump($previousgrnData);
  exit();
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

  var_dump($numbgrn);
  var_dump($dategrn);
  var_dump($clientgrn);
  var_dump($purposegrn);
  var_dump($moisturegrn);
  var_dump($weightgrn);
  exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($ids as $id){
    $sheet->setCellValue('A'.$rowCounter,$id);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($items as $item){
    $sheet->setCellValue('B'.$rowCounter2,$item);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($qtyIn as $in){
    $sheet->setCellValue('C'.$rowCounter3,$in);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($qtyOut as $out){
    $sheet->setCellValue('D'.$rowCounter4,$out);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($balance as $bal){
    $sheet->setCellValue('E'.$rowCounter5,$bal);
    $rowCounter5++;
  }

    $fileName = "Stock Balance".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);

}
?>