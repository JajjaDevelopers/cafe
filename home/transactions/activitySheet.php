<?php 
$pageTitle="Activity Sheet";
include "../forms/header.php";
include("../connection/activitySheetVariables.php");
?>
<form class="regularForm" style="height: fit-content; width: 794px">
    <?php include "../templates/activitySheet.php" ?>
    <?php include "../forms/users.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/salesReportList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/salesinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/salesReport.php" ?>