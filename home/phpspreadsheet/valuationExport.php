
<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["stockBalanceData"];
// exit();
if(isset($_SESSION["valuationData"])){
  $valuationData= json_decode($_SESSION["valuationData"]);
  $valnumb = array();
  $dateval = array();
  $clientval = array();
  $grossvalue= array();
  $costs = array();
  $netvalue= array();
 
  for ($i = 0; $i<count($valuationData);$i++){
    for($j=0;$j<count($valuationData[$i]);$j++){
    }
    array_push($valnumb, $valuationData[$i][0]);
    array_push($dateval,$valuationData[$i][1]);
    array_push($clientval,$valuationData[$i][2]);
    array_push($grossvalue,$valuationData[$i][3]);
    array_push($costs,$valuationData[$i][4]);
    array_push($netvalue,$valuationData[$i][5]);
  }

  // var_dump($valnumb);
  // var_dump($dateval);
  // var_dump($clientval);
  // var_dump($grossvalue);
  // var_dump($costs);
  // var_dump($netvalue);
  // // var_dump($releaseData);
  // exit();

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($valnumb as $grn){
    $sheet->setCellValue('A'.$rowCounter,$grn);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($dateval as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientval as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($grossvalue as $gross){
    $sheet->setCellValue('D'.$rowCounter4,$gross);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($costs as $cost){
    $sheet->setCellValue('E'.$rowCounter5,$cost);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($netvalue as $net){
    $sheet->setCellValue('F'.$rowCounter6,$net);
    $rowCounter6++;
  }


    $fileName = "Valuation Info".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);
  

}
?>