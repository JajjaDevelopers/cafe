<?php $pageTitle = "Transfer Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/transfervariables.php";?>
<?php
$transferNo = formatDocNo(intval($transNo), "GTN-");
$_SESSION["transNo"] = $transNo;
?>
<form class="regularForm" method="post" action="../connection/transferVerification.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/transfer.php";
  include "../forms/users.php";
  submitButton("Verify", "submit", "btnSubmit")
  ?>
 <a href="../verification/transferList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<script>document.getElementById("print").style.display="none"</script>
<?php
include "../forms/footer.php";
include "../assets/js/transfer.php"
?>
