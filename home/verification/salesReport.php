<?php include "../forms/header.php" ?>
<?php include("../connection/salesReportVariables.php") ?>
<form class="regularForm" method="post" action="../connection/salesReportVerification.php" style="height: fit-content;">
    <?php include "../templates/salesReport.php" ?>
    <?php submitButton("Verify", "submit", "btnSubmit") ?>
    <?php include "../forms/users.php" ?>
</form>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/salesReport.php" ?>