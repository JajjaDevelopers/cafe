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
    $sql = $conn->prepare("SELECT contract_no, reference_no, customer_name, incoterms, shipment_date, DATEDIFF(shipment_date,now()) AS days, 
    (SELECT currency FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no LIMIT 1) AS currency,
    (SELECT sum(qty*avg_price) FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no ) AS value,
    (SELECT sum(qty) FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no ) AS contQty,
    (SELECT sum(allocated_qty) FROM contract_stock_allocation WHERE contracts_summary.contract_no=contract_stock_allocation.contract_no ) AS contQty
    FROM contracts_summary JOIN customer USING (customer_id)
    WHERE (contract_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT contract_no, reference_no, customer_name, incoterms, shipment_date, DATEDIFF(shipment_date,now()) AS days, 
    (SELECT currency FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no LIMIT 1) AS currency,
    (SELECT sum(qty*avg_price) FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no ) AS value,
    (SELECT sum(qty) FROM contract_offers WHERE contracts_summary.contract_no=contract_offers.contract_no ) AS contQty,
    (SELECT sum(allocated_qty) FROM contract_stock_allocation WHERE contracts_summary.contract_no=contract_stock_allocation.contract_no ) AS allocQty
    FROM contracts_summary JOIN customer USING (customer_id)
    WHERE (contract_date BETWEEN ? AND ? AND customer_id=?)");
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}
$sql->execute();
$sql->bind_result($contNo, $ref, $client, $terms, $shipDate, $days, $currency, $value, $contQty, $allocQty);
if ($client=='all'){
    $clientName = "All";
}else{
    $clientName = getFullName("customer_name", "customer", "customer_id", $client);
}
?>
<h6>Contracts List for <?=$clientName?> made between <?=$frmDate?> and <?=$toDate?></h6>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color: white;">
            <th style="width: 50px;">Contract No.</th>
            <th style="width: 100px;">Reference</th>
            <th >Client Name</th>
            <th >Incoterms</th>
            <th style="width: 100px;">Shipment Date</th>
            <th style="width: 80px;">Days to Shipment</th>
            <th>Status</th>
            <th style="width: 80px;">Currency</th>
            <th style="width: 100px;">Contract Value </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $salesList = array(["Contract No", "Reference", "Client Name", "Incoterms", "Shipment Date",  "Days to Shipment", "Status", "Currency", "Contract Value"]);
        while ($sql->fetch()){
            if ($contQty>$allocQty){
                $status="Pending Stock Allocation";
                $state = 1;
            }elseif ($contQty<=$allocQty) {
                $status="Ready for Shipment";
                $state = 2;
            }
            
            $salesRow = [$contNo, $ref, $client, $terms, $shipDate, $days, $status, $currency, $value];
            array_push($salesList, $salesRow);
            ?>
            <tr>
                <td><a href="../reports/contractOffer?contNo=<?= $contNo ?>&stt=<?= $state ?>"><?= $contNo ?></a></td>
                <td><?= $ref ?></td>
                <td><?= $client ?></td>
                <td style="text-align:left"><?= $terms ?></td>
                <td><?= $shipDate ?></td>
                <td style="text-align:center"><?= $days?></td>
                <td style="text-align:left"><?= $status?></td>
                <td style="text-align:right"><?= $currency?></td>
                <td style="text-align:right"><?= num($value)?></td>

            </tr>
            <?php
        }
        $salesListResult = json_encode($salesList);
        // echo $salesListResult;
        $_SESSION["salesData"] = $salesListResult;
        // echo $_SESSION["salesData"];
        ?>
    </tbody>


    <?php
//1 for pending, 2 for dispatched










?>