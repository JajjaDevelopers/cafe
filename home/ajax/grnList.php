
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
    $sql = $conn->prepare("SELECT grn_no, grn_date, customer_name, purpose, grn_mc, grn_qty FROM grn JOIN customer USING (customer_id)
    WHERE (grn_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT grn_no, grn_date, customer_name, purpose, grn_mc, grn_qty FROM grn JOIN customer USING (customer_id)
    WHERE (grn_date BETWEEN ? AND ? AND customer_id=?)");
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$result = $sql->get_result();

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">GRN No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th style="width: 200px;">Purpose</th>
            <th style="width: 100px;">Moisture (%)</th>
            <th style="width: 150px;">Weight (Kg)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()){
           ?>
           <tr>
                <td><a href="../transactions/grn.php?grnNo=<?=$row["grn_no"]?>"> <?=$row["grn_no"]?> </a></td>
                <td><?=$row["grn_date"]?></td>
                <td><?=$row["customer_name"]?></td>
                <td><?=$row["purpose"]?></td>
                <td style="text-align: center;"><?=$row["grn_mc"]?></td>
                <td style="text-align: right;"><?=$row["grn_qty"]?></td>
           </tr>
           <?php
        }


?>
    </tbody>
</table>
