<?php
$pageTitle = "Batch Order";
include "../connection/databaseConn.php";
include "../forms/header.php";
$batchOrderNo = nextDocNumber("batch_processing_order", "batch_order_no", "BOD");
?>
<form class="regularForm" style="height: fit-content;">
    <h3 class="formHeading">Batch Order Combination</h3>
    <table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Aggregation Method</th>
            <th style="width: 100px;">Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><h6><a href="../processing/multiGrnBatch">Combine GRNs</a></h6></td>
            <td>Combine different GRNs for the same customer into one batch for processing</td>
        </tr>
        <tr>
            <td><h6><a href="../processing/multiClientBatch">Combine Clients</a></h6></td>
            <td>Combine different Clients to form one batch for processing</td>
        </tr>
    </tbody>
    </table>
</form>
<?php include "../forms/footer.php";?>