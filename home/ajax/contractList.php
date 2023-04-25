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
    $sql = $conn->prepare("SELECT contract_offers.contract_no, reference_no, customer_name, grade_name, incoterms, shipment_date, DATEDIFF(shipment_date,now()) AS days, 
    currency, (qty*avg_price) AS value, (qty)  AS contQty,
    (SELECT sum(allocated_qty) FROM contract_stock_allocation WHERE contract_stock_allocation.contract_no=contract_offers.contract_no 
    AND contract_stock_allocation.grade_id=contract_offers.grade_id ) AS allocated
    FROM contract_offers JOIN contracts_summary USING (contract_no) JOIN customer USING (customer_id)  JOIN grades USING (grade_id)
    WHERE (contract_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT contract_offers.contract_no, reference_no, customer_name, grade_name, incoterms, shipment_date, DATEDIFF(shipment_date,now()) AS days, 
    currency, (qty*avg_price) AS value, (qty)  AS contQty,
    (SELECT sum(allocated_qty) FROM contract_stock_allocation WHERE contract_stock_allocation.contract_no=contract_offers.contract_no 
    AND contract_stock_allocation.grade_id=contract_offers.grade_id ) AS allocated
    FROM contract_offers JOIN contracts_summary USING (contract_no) JOIN customer USING (customer_id)  JOIN grades USING (grade_id)
    WHERE (contract_date BETWEEN ? AND ? AND customer_id=?)");
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}
$sql->execute();
$sql->bind_result($contNo, $ref, $client, $item, $terms, $shipDate, $days, $currency, $value, $contQty, $allocQty);
if ($client=='all'){
    $clientName = "All Clients";
}else{
    $clientName = getFullName("customer_name", "customer", "customer_id", $client);
}
?>
<h6>Offer List for <?=$clientName?> made between <?=$frmDate?> and <?=$toDate?></h6>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color: white;">
            <th style="width: 50px;">Offer No.</th>
            <th style="width: 100px;">Reference</th>
            <th >Client Name</th>
            <th >Coffee Grade</th>
            <th >Incoterms</th>
            <th style="width: 100px;">Shipment Date</th>
            <th style="width: 80px;">Days to Shipment</th>
            <th>Status</th>
            <th style="width: 80px;">Currency</th>
            <th style="width: 130px;">Contract Value </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $contractsList = array(["Contract No", "Reference", "Client Name","Coffee Grade", "Incoterms", "Shipment Date",  "Days to Shipment", "Status", "Currency", "Contract Value"]);
        while ($sql->fetch()){
            if ($contQty>$allocQty){
                $status="Pending Stock Allocation";
                $state = 1;
            }elseif ($contQty<=$allocQty) {
                $status="Ready for Shipment";
                $state = 2;
            }
            
            $contractsRow = [$contNo, $ref, $client,$item,$terms, $shipDate, $days, $status, $currency, $value];
            array_push($contractsList, $contractsRow);
            ?>
            <tr>
                <td><a href="../reports/contractOffer?contNo=<?= $contNo ?>&stt=<?= $state ?>"><?= $contNo ?></a></td>
                <td><?= $ref ?></td>
                <td><?= $client ?></td>
                <td><?= $item ?></td>
                <td style="text-align:left"><?= $terms ?></td>
                <td><?= $shipDate ?></td>
                <td style="text-align:center"><?= $days?></td>
                <td style="text-align:left"><?= $status?></td>
                <td style="text-align:right"><?= $currency?></td>
                <td style="text-align:right"><?= num($value)?></td>

            </tr>
            <?php
        }
        $contractsListResult = json_encode($contractsList);
        // echo $contractsListResult;
        $_SESSION["contractsData"] = $contractsListResult;
        // echo $_SESSION["salesData"];
        ?>
    </tbody>


    <?php
//1 for pending, 2 for dispatched










?>