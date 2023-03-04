<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/valuationVariables.php";?>
<?php include ("../connection/databaseConn.php");?>

<form class="regularForm" method="post" action="../connection/valuationVerification.php" style="height:fit-content; width:900px">
    <?php include "../templates/valuation.php" ?>
    <?php submitButton("Verify", "submit", "btnSubmit") ?>
    <a href="../verification/valuationList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<script>document.getElementById("print").style.display="none";</script>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/valuationVer.php" ?>