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
    $sql = $conn->prepare("SELECT count_no, count_date, customer_name, deficit, excess, (excess-deficit) AS net_qty, comment
                            FROM stock_counting JOIN customer USING(customer_id) 
                            WHERE (count_date BETWEEN ? AND ?)");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT count_no, count_date, customer_name, deficit, excess, (excess-deficit) AS net_qty, comment
                            FROM stock_counting JOIN customer USING(customer_id) 
                            WHERE (count_date BETWEEN ? AND ? AND customer_id=?)");
                            
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($no, $countDate, $client, $ttDeicit, $ttExcess, $ttNet, $notes);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Count. No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th style="width: 100px;">Total Deficit (Kg)</th>
            <th style="width: 100px;">Total Excess (Kg)</th>
            <th style="width: 100px;">Net Qty (Kg)</th>
            <th >Comment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $countList = array(["Count. No", "Date", "Client Name", "Total Deficit (Kg)", "Total Excess (Kg)", "Net Qty (Kg)","Comment"]);
        while ($sql->fetch()){
            $myRow = [$no, $countDate, $client, $ttDeicit, $ttExcess, $ttNet, $notes];
            array_push($countList, $myRow);
           ?>
           <tr>
                <td><a href="../transactions/stockCount?countNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$countDate?></td>
                <td><?=$client?></td>
                <td><?=$ttDeicit?></td>
                <td style="text-align: right;"><?=$ttExcess?></td>
                <td style="text-align: right;"><?=$ttNet?></td>
                <td style="text-align: left;"><?=$notes?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$countListResult = json_encode($countList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["bulkData"] = $countListResult;
// echo $_SESSION["goodsreceivedData"];
$sql->close();
?>
