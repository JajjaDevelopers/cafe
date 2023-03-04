<?php $pageTitle = "Bulking Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/bulkingVariables.php";?>
<?php
$bulkingNo = formatDocNo(intval($bulkNo), "BLK-");
$_SESSION["bulkNo"] = $bulkNo;
?>
<form class="regularForm" method="post" action="../connection/bulkingVerification.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/bulking.php";
  include "../forms/users.php";
  submitButton("Verify", "submit", "btnSubmit1");
  ?>
   <a href="../verification/bulkingList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<script>document.getElementById("print").style.display="none"</script>
<?php
include "../forms/footer.php";
include "../assets/js/bulking.php";
?>