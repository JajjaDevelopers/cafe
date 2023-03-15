<?php
$pageTitle = "Batch Order";
include "../connection/databaseConn.php";
include "../forms/header.php";
$batchOrderNo = nextDocNumber("batch_processing_order", "batch_order_no", "BOD");
?>
<form class="regularForm" id="batchCombn" style="height: fit-content; width:900px">
    <h3 class="formHeading">Batch Activity Selection</h3>

    <table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 200px;">Aggregation Method</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><h6><a href="../processing/multiGrnBatch">Combine GRNs</a></h6></td>
            <td>Combine different GRNs for the same client to form one batch for processing</td>
        </tr>
        <tr>
            <td><h6><a href="../processing/multiClientBatch">Combine Clients</a></h6></td>
            <td>Combine different Clients to form one batch for processing</td>
        </tr>
        <tr>
            <td><h6><a href="../processing/directOrder">Direct</a></h6></td>
            <td>Processing activity done directly for the customers</td>
        </tr>
    </tbody>
    </table>
</form>
<?php include "../forms/footer.php";?>
