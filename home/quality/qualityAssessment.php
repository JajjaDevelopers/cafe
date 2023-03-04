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
<form class="regularForm" method="post" action="../connection/qualityAssessment.php" style="height:fit-content">
<?php include "../templates/qualityAssessment.php" ?>
<?php submitButton("Submit", "submit", "btnSubmit") ?>
</form>

<?php include_once ("../forms/footer.php")?>
<script>
    document.getElementById("salesReportBuyer").style.display="none";
    // 

</script>