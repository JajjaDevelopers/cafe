<?php $pageTitle="Select Batch Order"; ?>
<?php include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
include ("../ajax/batchReportReturnsAjax.php");
?>
<form id="batchReportForm" class="regularForm"action="batchReport.php" method="POST" style="width: 1000px;">
    <h3 id="batchReportHeading" class="formHeading"><?=$_GET['act']." "?>Batch Order Selection</h3>
    <?php
        include "../alerts/message.php";
        include "../connection/batchOrders.php";
     ?>
</form>
<?php include "../forms/footer.php" ?>
    

