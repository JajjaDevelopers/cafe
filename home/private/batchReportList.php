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
    $sql = $conn->prepare("SELECT batch_report_no, batch_report_date, customer_name, grade_name, net_input, comment
                            FROM batch_reports_summary JOIN grn USING (batch_order_no)
                            JOIN grades USING(grade_id) JOIN customer USING(customer_id) 
                            WHERE (bulk_date BETWEEN ? AND ?)");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT bulk_no, bulk_date, customer_name, grade_name, qty, comment
                        FROM bulking JOIN grades USING(grade_id) JOIN customer USING(customer_id) 
                        WHERE (bulk_date BETWEEN ? AND ? AND customer_id=?)");
                            
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($no, $bulkDate, $client, $grade, $ttQy, $notes);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Bulk. No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th >Grade</th>
            <th style="width: 100px;">Total Qty (Kg)</th>
            <th >Comment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $bulkList = array(["Bulk. No", "Date", "Client Name", "Grade", "Total Qty (Kg)", "Comment"]);
        while ($sql->fetch()){
            $myRow = [$no, $bulkDate, $client, $grade, $ttQy, $notes];
            array_push($bulkList, $myRow);
           ?>
           <tr>
                <td><a href="../transactions/bulking?bulkNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$bulkDate?></td>
                <td><?=$client?></td>
                <td><?=$grade?></td>
                <td style="text-align: right;"><?=$ttQy?></td>
                <td style="text-align: left;"><?=$notes?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$bulkingListResult = json_encode($bulkList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["bulkData"] = $bulkingListResult;
// echo $_SESSION["goodsreceivedData"];
$sql->close();
?>
