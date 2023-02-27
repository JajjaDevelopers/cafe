<?php
session_start();
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// echo $_SESSION["bulkData"];
// exit();
if(isset($_SESSION["bulkData"])){

  $dataBulk = json_decode($_SESSION["bulkData"]);

  $bulno = array();
  $datebul = array();
  $clientbul = array();
  $grade = array();
  $totalqty= array();
  $comment= array();

  for ($i = 0; $i<count($dataBulk);$i++){
    for($j=0;$j<count($dataBulk[$i]);$j++){
    }
    array_push($bulno, $dataBulk[$i][0]);
    array_push($datebul,$dataBulk[$i][1]);
    array_push($clientbul,$dataBulk[$i][2]);
    array_push($grade,$dataBulk[$i][3]);
    array_push($totalqty,$dataBulk[$i][4]);
    array_push($comment,$dataBulk[$i][5]);

  }


  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  //populating data into the columns
  $rowCounter = 1;
  foreach($bulno as $id){
    $sheet->setCellValue('A'.$rowCounter,$id);
    $rowCounter++;
  }

  $rowCounter2 = 1;
  foreach($datebul as $date){
    $sheet->setCellValue('B'.$rowCounter2,$date);
    $rowCounter2++;
  }

  $rowCounter3=1;
  foreach($clientbul as $client){
    $sheet->setCellValue('C'.$rowCounter3,$client);
    $rowCounter3++;
  }
  $rowCounter4 = 1;
  foreach($grade as $grad){
    $sheet->setCellValue('D'.$rowCounter4,$grad);
    $rowCounter4++;
  }
  $rowCounter5 = 1;
  foreach($totalqty as $qty){
    $sheet->setCellValue('E'.$rowCounter5,$qty);
    $rowCounter5++;
  }
  $rowCounter6 = 1;
  foreach($comment as $com){
    $sheet->setCellValue('F'.$rowCounter6,$com);
    $rowCounter6++;
  }

    $fileName = "bulk".".xlsx";//name of exported excel
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");	
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    // $writer->save($fileName);

}
?>