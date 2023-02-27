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
    $sql = $conn->prepare("SELECT adj_no, adj_date, customer_name, items_no, qty_add, qty_less, comment
                            FROM adjustment JOIN customer USING(customer_id) 
                            WHERE (adj_date BETWEEN ? AND ?)");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT adj_no, adj_date, customer_name, items_no, qty_add, qty_less, comment
                            FROM adjustment JOIN customer USING(customer_id)
                        WHERE (adj_date BETWEEN ? AND ? AND customer_id=?)");
                            
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($no, $adjDate, $client, $itmsNo, $qtyAdd, $qtyLess, $notes);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Adjust. No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th style="width: 100px;">Affected</th>
            <th style="width: 100px;">Added (Kg)</th>
            <th style="width: 100px;">Reduced (Kg)</th>
            <th >Comment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $adjkList = array(["Adjust. No", "Date", "Client Name", "Affected", "Added (Kg)", "Reduced (Kg)","Comment"]);
        while ($sql->fetch()){
            $myRow = [$no, $adjDate, $client, $itmsNo, $qtyAdd, $qtyLess, $notes];
            array_push($adjkList, $myRow);
           ?>
           <tr>
                <td><a href="../transactions/adjustment?adjustNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$adjDate?></td>
                <td><?=$client?></td>
                <td><?=$itmsNo?></td>
                <td style="text-align: right;"><?=$qtyAdd?></td>
                <td style="text-align: right;"><?=$qtyLess?></td>
                <td style="text-align: left;"><?=$notes?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$adjustListResult = json_encode($adjkList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["bulkData"] = $adjustListResult;
// echo $_SESSION["goodsreceivedData"];
$sql->close();
?>
