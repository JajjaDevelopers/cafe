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
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
    <a href="../verification/adjustmentList" class="btn btn-link" style="color:green">Back</a>
    <!-- <a href="../pdfgen/bulkinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a> -->
</div>
</form>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php
include "../forms/footer.php";
include "../assets/js/adjustment.php";
?>


