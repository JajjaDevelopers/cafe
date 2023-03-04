<?php
session_start();
include("../private/functions.php");
include ("../private/connlogin.php");
?>

<?php
$frmDate = $_GET["startDate"]; 
$toDate = $_GET["endDate"];
$client = $_GET["custId"];

//criteria
if ($client == "all"){
    $sql = $conn->prepare("SELECT batch_report_no, batch_report_date, customer_name, grade_name, net_input, 
    (SELECT sum(qty_in) FROM inventory JOIN grades USING(grade_id) WHERE inventory_reference='Batch Report' AND grade_type='HIGH'
    AND batch_reports_summary.batch_report_no=inventory.document_number)
    AS net_outturn FROM batch_reports_summary JOIN grn USING (batch_order_no)
    JOIN grades USING(grade_id) JOIN customer WHERE (batch_reports_summary.customer_id=customer.customer_id
    AND batch_report_date BETWEEN ? AND ?) GROUP BY batch_report_no");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT batch_report_no, batch_report_date, customer_name, grade_name, net_input, 
    (SELECT sum(qty_in) FROM inventory JOIN grades USING(grade_id) WHERE inventory_reference='Batch Report' AND grade_type='HIGH'
    AND batch_reports_summary.batch_report_no=inventory.document_number)
    AS net_outturn FROM batch_reports_summary JOIN grn USING (batch_order_no)
    JOIN grades USING(grade_id) JOIN customer WHERE (batch_reports_summary.customer_id=customer.customer_id
    AND batch_report_date BETWEEN ? AND ? AND customer_id=?) GROUP BY batch_report_no");
                            
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($no, $batchkDate, $client, $grade, $netInput, $outTurn);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Batch. No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th >Input Grade</th>
            <th style="width: 100px;">Net Input (Kg)</th>
            <th style="width: 100px;">Out Turn (Kg)</th>
            <th style="width: 100px;">Net Out Turn (%)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $batchList = array(["Batch. No", "Date", "Client Name", "Input Grade", "Net Input (Kg)", "Out Turn (Kg)", "Out Turn (%)"]);
        while ($sql->fetch()){
            $myRow = [$no, $batchkDate, $client, $grade, $netInput, $outTurn, ($outTurn*100/$netInput)];
            array_push($batchList, $myRow);
           ?>
           <tr>
                <td><a href="../transactions/batchReport?batchNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$batchkDate?></td>
                <td><?=$client?></td>
                <td><?=$grade?></td>
                <td style="text-align: right;"><?=round($netInput,2)?></td>
                <td style="text-align: right;"><?=round($outTurn,2)?></td>
                <td style="text-align: center;"><?=round($outTurn*100/$netInput,2)?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$batchListResult = json_encode($batchList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["batchData"] = $batchListResult;
// echo $_SESSION["batchData"];
$sql->close();
?>
