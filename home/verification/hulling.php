<?php $pageTitle="Hulling Report"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/hullingVariables.php";?>
<?php include ("../connection/databaseConn.php");?>

<form class="regularForm" method="post" action="../connection/hullingVerification.php" style="height:fit-content; width:800px">
    <?php include "../templates/hulling.php" ?>
<?php submitButton("Verify", "submit", "btnSubmit") ?>
<a href="../verification/hullingList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<script>document.getElementById("print").style.display="none"</script>
<?php include "../forms/footer.php" ?>
<?php include("../assets/js/hullingVer.php") ?>