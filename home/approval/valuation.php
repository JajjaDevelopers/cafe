<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/valuationVariables.php";?>
<?php include ("../connection/databaseConn.php");?>

<form class="regularForm" method="post" action="../connection/valuationApproval.php" style="height:fit-content; width:900px">
    <?php include "../templates/valuation.php" ?>
    <?php submitButton("Approve", "submit", "btnSubmit") ?>
</form>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/valuationVer.php" ?>