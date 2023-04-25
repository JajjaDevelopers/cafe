<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
if(isset($_SESSION["contractsData"])){
  $contractsData= json_decode($_SESSION["contractsData"]);
  // var_dump($contractsData);
  // exit();
  $contractsnumb = array();
  $contractsref = array();
  $clientsnam = array();
  $grade= array();
  $terms= array();
  $date = array();
  $daysToShipment= array();
  $status= array();
  $currency= array();
  $value= array();
 
  for ($i = 0; $i<count($contractsData);$i++){
    for($j=0;$j<count($contractsData[$i]);$j++){
    }
    array_push($contractsnumb, $contractsData[$i][0]);
    array_push($contractsref,$contractsData[$i][1]);
    array_push($clientsnam,$contractsData[$i][2]);
    array_push($grade,$contractsData[$i][3]);
    array_push($terms,$contractsData[$i][4]);
    array_push($date,$contractsData[$i][5]);
    array_push($daysToShipment,$contractsData[$i][6]);
    array_push($status,$contractsData[$i][7]);
    array_push($currency,$contractsData[$i][8]);
    array_push($value,$contractsData[$i][9]);
  }

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($contractsnumb as $numb){
    $sheet->setCellValue('A'.$rowCounter,$numb);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($contractsref as $ref){
    $sheet->setCellValue('B'.$rowCounter2,$ref);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientsnam as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($grade as $grad){
    $sheet->setCellValue('D'.$rowCounter4,$grad);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($terms as $term){
    $sheet->setCellValue('E'.$rowCounter5,$term);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($date as $date){
    $sheet->setCellValue('F'.$rowCounter6,$date);
    $rowCounter6++;
  }
  $rowCounter7 = 1;
  foreach($daysToShipment as $dos){
    $sheet->setCellValue('G'.$rowCounter7,$dos);
    $rowCounter7++;
  }
  $rowCounter8 = 1;
  foreach($status as $stat){
    $sheet->setCellValue('H'.$rowCounter8,$stat);
    $rowCounter8++;
  }
  $rowCounter9 = 1;
  foreach($currency as $curr){
    $sheet->setCellValue('I'.$rowCounter9,$curr);
    $rowCounter9++;
  }
  $rowCounter10 = 1;
  foreach($value as $val){
    $sheet->setCellValue('J'.$rowCounter10,$val);
    $rowCounter10++;
  }


    $fileName = "Sales Contracts Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
}
?>
