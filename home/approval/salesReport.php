<?php include "../forms/header.php" ?>
<?php include("../connection/salesReportVariables.php") ?>
<form class="regularForm" method="post" action="../connection/salesReportApproval.php" style="height: fit-content;">
    <?php include "../templates/salesReport.php" ?>
    <?php submitButton("Approve", "submit", "btnSubmit") ?>
    <?php include "../forms/users.php" ?>
</form>
<?php include "../forms/footer.php" ?>
<script>document.getElementById("print").style.display="none"</script>
<?php include "../assets/js/salesReport.php" ?>