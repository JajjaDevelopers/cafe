<?php $pageTitle = "Stock Adjustment Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/adjustmentVariables.php";?>
<?php
if(isset($_GET['adjustNo'])){
  $adjustvariable=$_GET['adjustNo'];
  // $_SESSION["dryNo"] = $dry;
  $_SESSION["adjustNo"] = $adjustvariable;
}
?>
<form class="regularForm" method="post" action="../connection/adjustmentVerification.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/adjustment.php";
  include "../forms/users.php";
  submitButton("Verify", "submit", "btnSubmit")
  ?>
  <a href="../verification/adjustmentList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php
include "../forms/footer.php";
include "../assets/js/adjustment.php";
?>


