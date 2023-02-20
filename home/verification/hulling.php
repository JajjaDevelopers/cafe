<?php $pageTitle="Hulling Report"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/hullingVariables.php";?>
<?php include ("../connection/databaseConn.php");?>

<form class="regularForm" method="post" action="../connection/hullingVerification.php" style="height:fit-content; width:800px">
    <?php include "../templates/hulling.php" ?>
<?php submitButton("Verify", "submit", "btnSubmit") ?>
</form>
<?php include "../forms/footer.php" ?>
<?php include("../assets/js/hullingVer.php") ?>