<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["batchdata"];
// exit();
if(isset($_SESSION["batchData"])){

  $batchdata = json_decode($_SESSION["batchData"]);
  $batchno = array();
  $datebatch = array();
  $clientbatch = array();
  $inputgrade = array();
  $netinput= array();
  $outturnkg= array();
  $outturnper= array();

  for ($i = 0; $i<count($batchdata);$i++){
    for($j=0;$j<count($batchdata[$i]);$j++){
    }
    array_push($batchno, $batchdata[$i][0]);
    array_push($datebatch,$batchdata[$i][1]);
    array_push($clientbatch,$batchdata[$i][2]);
    array_push($inputgrade,$batchdata[$i][3]);
    array_push($netinput,$batchdata[$i][4]);
    array_push($outturnkg,$batchdata[$i][5]);
    array_push($outturnper,$batchdata[$i][6]);
  }


  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($batchno as $id){
    $sheet->setCellValue('A'.$rowCounter,$id);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datebatch as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientbatch as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($inputgrade as $grad){
    $sheet->setCellValue('D'.$rowCounter4,$grad);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($netinput as $qty){
    $sheet->setCellValue('E'.$rowCounter5,$qty);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($outturnkg as $kg){
    $sheet->setCellValue('F'.$rowCounter6,$kg);
    $rowCounter6++;
  }

  $rowCounter7 = 1;
  foreach($outturnper as $per){
    $sheet->setCellValue('H'.$rowCounter7,$per);
    $rowCounter7++;
  }


    $fileName = "batch".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);

}
?>