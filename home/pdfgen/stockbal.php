<?php session_start();

 if (isset($_SESSION["data"])){

  $data = json_decode($_SESSION["data"]);
  $ids = array();
  $items = array();
  $qtyIn = array();
  $qtyOut = array();
  $balance= array();

  for ($i = 0; $i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
    
    array_push($ids, $data[$i][0]);
    array_push($items, $data[$i][1]);
    array_push($qtyIn, $data[$i][2]);
    array_push($qtyOut, $data[$i][3]);
    array_push($balance, $data[$i][4]);
  }

  }
  
 }
?>
<?php

 require_once "../pdf/vendor/autoload.php";
 use Dompdf\Dompdf;
$html='<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stoch Balance</title>
  <link href="bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
  <table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white">
            <th>ID</th>
            <th>Item</th>
            <th>Qty In</th>
            <th>Qty Out</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>';

    for($i=1;$i<count($ids);$i++){
      $html.='  <tr>
      <td>'.$ids[$i].'</td>
      <td>'.$items[$i].'</td>
      <td style="text-align: right;">'.$qtyIn[$i].'</td>
      <td style="text-align: right;">'.$qtyOut[$i].'</td>
      <td style="text-align: right;">'.$balance[$i].'</td>
    </tr>';
    }
    $html .= ' </tbody> 
    </table>
    </div>
  </body>
  </html>';

  $dompdf=new Dompdf();
  $dompdf->loadHtml($html);
  $dompdf->setPaper('A4','portrait');
  $dompdf->render();
  $dompdf->stream('stockbalance.pdf',['Attachment'=>0]);


?>