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
    $sql = $conn->prepare("SELECT transfer_no, transfer_date, 
    (SELECT customer_name FROM customer WHERE transfers.transfer_from=customer.customer_id) AS trans_from, 
    (SELECT customer_name FROM customer WHERE transfers.transfer_to=customer.customer_id) AS trans_to, notes,
    (SELECT sum(qty_out) AS qty_out FROM inventory WHERE inventory_reference='Transfer' 
    AND transfers.transfer_no=inventory.document_number) AS qty
    FROM transfers WHERE (transfer_date BETWEEN ? AND ?)");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT transfer_no, transfer_date, 
    (SELECT customer_name FROM customer WHERE transfers.transfer_from=customer.customer_id) AS trans_from, 
    (SELECT customer_name FROM customer WHERE transfers.transfer_to=customer.customer_id) AS trans_to, notes,
    (SELECT sum(qty_out) AS qty_out FROM inventory WHERE inventory_reference='Transfer' 
    AND transfers.transfer_no=inventory.document_number) AS qty
    FROM transfers WHERE (transfer_date BETWEEN ? AND ? AND (transfer_from=? OR transfer_to=?))");
                            
    $sql->bind_param("ssss", $frmDate, $toDate, $client, $client);
}

$sql->execute();
$sql->bind_result($no, $transDate, $frmClient, $toClient, $notes, $ttQy);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Trans. No</th>
            <th style="width: 100px;">Date</th>
            <th >From</th>
            <th >To</th>
            <th style="width: 100px;">Total Qty (Kg)</th>
            <th >Comment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $transferList = array(["Trans. No", "Date", "From", "To", "Total Qty (Kg)", "Comment"]);
        while ($sql->fetch()){
            $myRow = [$no, $transDate, $frmClient, $toClient, $ttQy, $notes];
            array_push($transferList, $myRow);
           ?>
           <tr>
                <td><a href="../transactions/transfer?transNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$transDate?></td>
                <td><?=$frmClient?></td>
                <td><?=$toClient?></td>
                <td style="text-align: right;"><?=$ttQy?></td>
                <td style="text-align: left;"><?=$notes?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$transferListResult = json_encode($transferList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["goodsreceivedData"] = $transferListResult;
// echo $_SESSION["goodsreceivedData"];
$sql->close();
?>
