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
    $sql = $conn->prepare("SELECT batch_order_no, customer_name, activity, grade_name, batch_order_input_qty, start_date, end_date, status
    FROM batch_processing_order JOIN grades USING (grade_id) JOIN customer USING (customer_id)
    WHERE (start_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT batch_order_no, customer_name, activity, grade_name, batch_order_input_qty, start_date, end_date, status
    FROM batch_processing_order JOIN grades USING (grade_id) JOIN customer USING (customer_id)
    WHERE (start_date BETWEEN ? AND ? AND customer_id=?)");
                            
    $sql->bind_param("ssss", $frmDate, $toDate, $client, $client);
}

$sql->execute();
$sql->bind_result($no, $client, $activity, $grade, $qty, $start, $end, $status);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 30px;">#</th>
            <th>Client</th>
            <th style="width: 150px;">Activity</th>
            <th >Item</th>
            <th style="width: 100px;">Start Date</th>
            <th style="width: 100px;">End Date</th>
            <th >Status</th>
            <th style="width: 100px;">Qty (Kg)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $scheduleList = array(["Client", "Activity", "Item", "Start Date", "End Date", "Status", "Qty (Kg)"]);
        $x=1;
        $totalQty=0;
        while ($sql->fetch()){
            $totalQty+=$qty;
            $myRow = [$client, $activity, $grade, $start, $end, $status, $qty];
            array_push($scheduleList, $myRow);
           ?>
           <tr>
                <td><?=$x?></td>
                <td><a href="#?transNo=<?=$no?>"> <?=$client?> </a></td>
                <td><?=$activity?></td>
                <td><?=$grade?></td>
                <td><?=$start?></td>
                <td><?=$end?></td>
                <td><?=$status?></td>
                <td style="text-align: right;"><?=num($qty)?></td>
           </tr>
           <?php
           $x+=1;
        }
        ?>
        <tr>
            <th colspan="7">Expected Total Qty (Kg)</th>
            <th style="text-align: right;"><?=num($totalQty)?></th>
        </tr>
    </tbody>
</table>
<?php
$scheduleListResult = json_encode($scheduleList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["transferData"] = $scheduleListResult;
// echo $_SESSION["transferData"];
$sql->close();
?>
