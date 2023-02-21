<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/releaseVariables.php" ?>
<?php include ("../connection/databaseConn.php");
 
?>


<form class="regularForm" method="POST" action="../connection/releaseVerification.php" style="height:fit-content; width:800px">
<input id="releaseNo" name="releaseNo" value="<?=$releaseNo?>" style="display:none" readonly>
<?php require "../templates/releaseTemplate.php" ?>

    <?php submitButton("Verify", "submit", "confirm"); ?>
</form>
<?php 
include "../forms/footer.php";
include "../assets/js/releaseVer.php"
?>
<script>document.getElementById("print").style.display="none";</script>
