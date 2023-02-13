<?php $pageTitle="Quality Assessment"; ?>
<?php
include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
$assessNo = nextDocNumber("gen_quality", "assess_no", "QAN");
$grnNo = $_GET['grnNo'];
// $gradeId = $_GET['grdId'];
// $qty = $_GET['qty'];
// $bags = $_GET['bags'];
// $purpose = $_GET['purpose'];
// $mc = $_GET['mc'];

include "../connection/qualityAssessVariables.php";
?>
<form class="regularForm" method="pos" action="" style="height:fit-content">
<?php include "../templates/qualityAssessment.php" ?>
<?php submitButton("Submit", "submit", "btnSubmit") ?>
</form>

<?php include_once ("../forms/footer.php")?>
<script>
    $('#salesReportBuyer').hide();
    $('#customerId').val("<?=$clientId?>");
    $('#customerName').val("<?=$clientName?>");
    $('#salesReportContact').val("<?=$contact?>");
    $('#salesReportTel').val("<?=$tel?>");
    $('#grnNo').val("<?= formatDocNo($grnNo, "") ?>");

</script>