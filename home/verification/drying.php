<?php $pageTitle = "Drying";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/dryingVariables.php";?>
<?php
$grnNo = formatDocNo(intval($grn_no), "GRN-");
$_SESSION["dryNo"] = $dryNo;
?>
<form class="regularForm" method="post" action="../connection/dryingVerification.php" style="height: fit-content; width:790px">

  <?php
  include "../templates/drying.php";
  submitButton("Verify", "submit", "btnSubmi");
  ?>
</form>
<script>document.getElementById("print").style.display="none"</script>
<?php
include "../forms/footer.php";
include "../assets/js/drying.php";
?>
