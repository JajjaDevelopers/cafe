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
    $sql = $conn->prepare("SELECT release_no, request_date, customer_name, total_qty, destination, status 
    FROM release_request JOIN customer USING (customer_id)
    WHERE (request_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT release_no, request_date, customer_name, total_qty, destination, status 
    FROM release_request JOIN customer USING (customer_id)
    WHERE (request_date BETWEEN ? AND ? AND customer_id=?)");
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
<h6>Release History for <?=$clientName?> between <?=$frmDate?> and <?=$toDate?></h6>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Release No</th>
            <th style="width: 100px;">Request Date</th>
            <th >Client Name</th>
            <th style="width: 150px;">Weight (Kg)</th>
            <th style="width: 200px;">Destination</th>
            <th style="width: 200px;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $releaseList = array(["Release No", "Request Date", "Client Name", "Weight (Kg)", "Destination", "Status"]);
        while ($row = $result->fetch_assoc()){
            if ($row["status"]==1){
                $status = "Pending Dispatch";
            }else{
                $status = "Dispatched";
            }
            $releaseRow = [$row["release_no"], $row["request_date"], $row["customer_name"], $row["total_qty"], $row["destination"], $status];
            array_push($releaseList, $releaseRow);
            ?>
            <tr>
                <td><a href="../transactions/release?relNo=<?= $row["release_no"] ?>"><?= $row["release_no"] ?></a></td>
                <td><?= $row["request_date"] ?></td>
                <td><?= $row["customer_name"] ?></td>
                <td style="text-align:right"><?= $row["total_qty"] ?></td>
                <td><?= $row["destination"] ?></td>
                <td><?= $status ?></td>

            </tr>
            <?php
        }
        $releaseListResult = json_encode($releaseList);
        echo $releaseListResult;
        ?>
    </tbody>


    <?php
//1 for pending, 2 for dispatched










?>