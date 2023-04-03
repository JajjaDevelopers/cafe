<?php
$request = $_GET['req'];
$frmDate = $_GET["startDate"]; 
$toDate = $_GET["endDate"];
$client = $_GET["custId"];

function salesReport(){
    include "../private/connlogin.php";
    include "../private/functions.php";
    global $frmDate, $toDate, $client;
    if ($client == "all"){
        $sql = $conn->prepare("SELECT trans_date, document_number AS sales_no, customer_name, grade_name, qty_in, price_ugx, 
        (qty_in* price_ugx) AS value 
        FROM inventory JOIN customer USING (customer_id)  JOIN grades USING (grade_id)
        WHERE (inventory_reference='Sales Report' AND qty_in<>0 AND trans_date BETWEEN ? AND ?)");
        $sql->bind_param("ss", $frmDate, $toDate);
    }else{
        $sql = $conn->prepare("SELECT trans_date, document_number AS sales_no, customer_name, grade_name, qty_in, price_ugx, 
        (qty_in* price_ugx) AS value 
        FROM inventory JOIN customer USING (customer_id)  JOIN grades USING (grade_id)
        WHERE (inventory_reference='Sales Report' AND qty_in<>0 AND trans_date BETWEEN ? AND ? AND customer_id=?)");
        $sql->bind_param("sss", $frmDate, $toDate, $client);
    }
    $sql->execute();
    $sql->bind_result($date, $salNo, $client, $item, $qty, $price, $value);
    if ($client=='all'){
        $clientName = "All Clients";
    }else{
        $clientName = getFullName("customer_name", "customer", "customer_id", $client);
    }
    ?>
    <h6>Green Coffee Sales from <?=$frmDate?> to <?=$toDate?></h6>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr style="background-color: green; color:white;">
                <th style="width: 100px;">Date</th>
                <th style="width: 100px;">Sales Number</th>
                <th >Client Name</th>
                <th >Particulars</th>
                <th style="width: 100px;">Qty (Kg)</th>
                <th style="width: 100px;">Avg. Price</th>
                <th style="width: 150px;">Amount</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $totalQty=0;
    $totalSales=0;
    while ($sql->fetch()){
        $totalQty+=$qty;
        $totalSales+=$value;
        ?>
        <tr>
            <td><?=$date?></td>
            <td><a href="../transactions/salesReport?salNo=<?=$salNo?>"> <?=$salNo?></a></td>
            <td><?=$client?></td>
            <td><?=$item?></td>
            <td style="text-align: right;"><?=num($qty)?></td>
            <td style="text-align: right;"><?=num($price)?></td>
            <td style="text-align: right;"><?=num($value)?></td>
        </tr>
        <?php
    }
    ?>
        <tr >
            <th colspan="4" style="text-align: right;">Total Sales</th>
            <td style="text-align: right;"><b><?=num($totalQty)?></b></td>
            <td style="text-align: right;"><b><?=num($totalSales/$totalQty)?></b></td>
            <td style="text-align: right;"><b><?=num($totalSales)?></b></td>
        </tr>
            
        </tbody>
    </table>
    <?php




}








if ($request=='salesReport'){
    salesReport();
}



?>