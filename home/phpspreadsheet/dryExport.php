<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["dryingData"])){

  $dryingData= json_decode($_SESSION["dryingData"]);
  $drynumb = array();
  $datedry = array();
  $clientdry = array();
  $gradedry= array();
  $inputdry = array();
  $mcin= array();
  $outputdry= array();
  $mcout= array();
  
 

  for ($i = 0; $i<count($dryingData);$i++){
    for($j=0;$j<count($dryingData[$i]);$j++){
    }
    array_push($drynumb, $dryingData[$i][0]);
    array_push($datedry,$dryingData[$i][1]);
    array_push($clientdry,$dryingData[$i][2]);
    array_push($gradedry,$dryingData[$i][3]);
    array_push($inputdry,$dryingData[$i][4]);
    array_push($mcin,$dryingData[$i][5]);
    array_push($outputdry,$dryingData[$i][6]);
    array_push($mcout,$dryingData[$i][7]);
  }

  

  // var_dump($relnumb);
  // var_dump($daterel);
  // var_dump($clientrel);
  // var_dump($weightrel);
  // var_dump($destinerel);
  // var_dump($statusrel);
  // // var_dump($dryingData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($drynumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datedry as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientdry as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($gradedry as $grade){
    $sheet->setCellValue('D'.$rowCounter4,$grade);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($inputdry as $indry){
    $sheet->setCellValue('E'.$rowCounter5,$indry);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($mcin as $in){
    $sheet->setCellValue('F'.$rowCounter6,$in);
    $rowCounter6++;
  }
  $rowCounter7 = 1;
  foreach($outputdry as $outdry){
    $sheet->setCellValue('G'.$rowCounter7,$outdry);
    $rowCounter7++;
  }
  $rowCounter8 = 1;
  foreach($mcout as $out){
    $sheet->setCellValue('H'.$rowCounter8,$out);
    $rowCounter8++;
  }


    $fileName = "Dry Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
  

}
?>