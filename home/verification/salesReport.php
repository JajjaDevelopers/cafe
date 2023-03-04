<?php include "../forms/header.php" ?>
<?php include("../connection/salesReportVariables.php") ?>
<form class="regularForm" method="post" action="../connection/salesReportVerification.php" style="height: fit-content;">
    <?php include "../templates/salesReport.php" ?>
    <?php submitButton("Verify", "submit", "btnSubmit") ?>
     <a href="../verification/salesReportList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
    <?php include "../forms/users.php" ?>
</form>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/salesReport.php" ?>