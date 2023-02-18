<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["stockBalanceData"])){

  $dataStockBal = json_decode($_SESSION["stockBalanceData"]);
  $ids = array();
  $items = array();
  $qtyIn = array();
  $qtyOut = array();
  $balance= array();

  for ($i = 0; $i<count($dataStockBal);$i++){
    for($j=0;$j<count($dataStockBal[$i]);$j++){
    }
    array_push($ids, $dataStockBal[$i][0]);
    array_push($items,$dataStockBal[$i][1]);
    array_push($qtyIn,$dataStockBal[$i][2]);
    array_push($qtyOut,$dataStockBal[$i][3]);
    array_push($balance,$dataStockBal[$i][4]);

  }

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