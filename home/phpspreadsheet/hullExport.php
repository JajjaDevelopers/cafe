<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["hullData"])){
  $hullData= json_decode($_SESSION["hullData"]);
  $hulnumb = array();
  $datehul = array();
  $clienthul = array();
  $inputgrade= array();
  $inputqty = array();
  $outputgrade= array();
  $outputqty= array();
 
  for ($i = 0; $i<count($hullData);$i++){
    for($j=0;$j<count($hullData[$i]);$j++){
    }
    array_push($hulnumb, $hullData[$i][0]);
    array_push($datehul,$hullData[$i][1]);
    array_push($clienthul,$hullData[$i][2]);
    array_push($inputgrade,$hullData[$i][3]);
    array_push($inputqty,$hullData[$i][4]);
    array_push($outputgrade,$hullData[$i][5]);
    array_push($outputqty,$hullData[$i][6]);
  }

  // var_dump($hulnumb);
  // var_dump($datehul);
  // var_dump($clienthul);
  // var_dump($inputgrade);
  // var_dump($inputqty);
  // var_dump($outputgrade);
  // var_dump($outputqty);
  // // var_dump($releaseData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($hulnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datehul as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clienthul as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($inputgrade as $gradein){
    $sheet->setCellValue('D'.$rowCounter4,$gradein);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($inputqty as $qtyin){
    $sheet->setCellValue('E'.$rowCounter5,$qtyin);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($outputgrade as $gradeout){
    $sheet->setCellValue('F'.$rowCounter6,$gradeout);
    $rowCounter6++;
  }

  $rowCounter7 = 1;
  foreach($outputqty as $qtyout){
    $sheet->setCellValue('G'.$rowCounter7,$qtyout);
    $rowCounter7++;
  }


    $fileName = "hull Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
}
?>