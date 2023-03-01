<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["stockCountData"])){
  $stockCountData= json_decode($_SESSION["stockCountData"]);
  $stocknumb = array();
  $datestock = array();
  $clientstock = array();
  $totaldeficient= array();
  $totalexcess = array();
  $netqty= array();
  $comment= array();
 
  for ($i = 0; $i<count($stockCountData);$i++){
    for($j=0;$j<count($stockCountData[$i]);$j++){
    }
    array_push($stocknumb, $stockCountData[$i][0]);
    array_push($datestock,$stockCountData[$i][1]);
    array_push($clientstock,$stockCountData[$i][2]);
    array_push($totaldeficient,$stockCountData[$i][3]);
    array_push($totalexcess,$stockCountData[$i][4]);
    array_push($netqty,$stockCountData[$i][5]);
    array_push($comment,$stockCountData[$i][6]);
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
  foreach($stocknumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datestock as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientstock as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($totaldeficient as $def){
    $sheet->setCellValue('D'.$rowCounter4,$def);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($totalexcess as $excess){
    $sheet->setCellValue('E'.$rowCounter5,$excess);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($netqty as $qty){
    $sheet->setCellValue('F'.$rowCounter6,$qty);
    $rowCounter6++;
  }

  $rowCounter7 = 1;
  foreach($comment as $com){
    $sheet->setCellValue('G'.$rowCounter7,$com);
    $rowCounter7++;
  }


    $fileName = "stockCount Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
}
?>