<?php
include("../private/functions.php");
include ("../private/connlogin.php");
?>

<?php
$frmDate = $_GET["startDate"]; 
$toDate = $_GET["endDate"];
$client = $_GET["custId"];

//criteria
if ($client == "all"){
    $sql = $conn->prepare("SELECT sales_report_no, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency
    FROM sales_reports_summary JOIN customer USING (customer_id)
    WHERE (sales_report_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT sales_report_no, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency
    FROM sales_reports_summary JOIN customer USING (customer_id)
    WHERE (sales_report_date BETWEEN ? AND ? AND customer_id=?)");
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
<h6>Sales Report History for <?=$clientName?> between <?=$frmDate?> and <?=$toDate?></h6>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color: white;">
            <th style="width: 100px;">Sales No.</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th style="width: 150px;">Category</th>
            <th style="width: 150px;">Currency</th>
            <th style="width: 150px;">Sales Value </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $valList = array(["Sales No", "Date", "Client Name", "Category", "Currency", "Sales Value"]);
        while ($row = $result->fetch_assoc()){
            $valRow = [$row["sales_report_no"], $row["sales_report_date"], $row["customer_name"], $row["sale_category"], $row["foreign_currency"], $row["sales_report_value"]];
            array_push($valList, $valRow);
            ?>
            <tr>
                <td><a href="../transactions/salesReport?valNo=<?= $row["sales_report_no"] ?>"><?= $row["sales_report_no"] ?></a></td>
                <td><?= $row["sales_report_date"] ?></td>
                <td><?= $row["customer_name"] ?></td>
                <td style="text-align:left"><?= $row["sale_category"] ?></td>
                <td><?= $row["foreign_currency"] ?></td>
                <td style="text-align:right"><?= $row["sales_report_value"]?></td>

            </tr>
            <?php
        }
        $valuationListResult = json_encode($valList);
        echo $valuationListResult;
        ?>
    </tbody>


    <?php
//1 for pending, 2 for dispatched










?>