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
    $sql = $conn->prepare("SELECT valuation_no, valuation_date, customer_name, sum(qty*price_ugx) AS gross_value, costs
    FROM valuation_report_summary JOIN valuations USING (valuation_no) JOIN customer USING (customer_id)
    WHERE (valuation_date BETWEEN ? AND ?) GROUP BY valuation_no");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT valuation_no, valuation_date, customer_name, sum(qty*price_ugx) AS gross_value, costs
    FROM valuation_report_summary JOIN valuations USING (valuation_no) JOIN customer USING (customer_id)
    WHERE (valuation_date BETWEEN ? AND ? AND valuation_report_summary.customer_id=?) GROUP BY valuation_no");
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}
$sql->execute();
$result = $sql->get_result();
if ($client=='all'){
    $clientName = "All";
}else{
    $clientName = getFullName("customer_name", "customer", "customer_id", $client);
}
?>
<h6>Valuation History for <?=$clientName?> between <?=$frmDate?> and <?=$toDate?></h6>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color: white;">
            <th style="width: 100px;">Valuation No.</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th style="width: 150px;">Gross Value (Ugx)</th>
            <th style="width: 150px;">Costs (Ugx)</th>
            <th style="width: 150px;">Net Value (Ugx)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $valList = array(["Valuation No", "Date", "Client Name", "Gross Value (Ugx)", "Costs (Ugx)", "Net Value (Ugx)"]);
        while ($row = $result->fetch_assoc()){
            $netValue = $row["gross_value"]-$row["costs"];
            $valRow = [$row["valuation_no"], $row["valuation_date"], $row["customer_name"], $row["gross_value"], $row["costs"], $netValue];
            array_push($valList, $valRow);
            ?>
            <tr>
                <td><a href="../transactions/valuation?valNo=<?= $row["valuation_no"] ?>"><?= $row["valuation_no"] ?></a></td>
                <td><?= $row["valuation_date"] ?></td>
                <td><?= $row["customer_name"] ?></td>
                <td style="text-align:right"><?= num($row["gross_value"]) ?></td>
                <td style="text-align: right;"><?= num($row["costs"]) ?></td>
                <td style="text-align: right;"><?= num($netValue) ?></td>

            </tr>
            <?php
        }
        $valuationListResult = json_encode($valList);
        // echo $valuationListResult;
        $_SESSION["valuationData"] = $valuationListResult;
        // echo $_SESSION["valuationData"];
        ?>
    </tbody>


    <?php
//1 for pending, 2 for dispatched










?>