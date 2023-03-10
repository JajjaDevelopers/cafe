<?php $pageTitle = "Bulking Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/bulkingVariables.php";?>
<?php
$bulkingNo = formatDocNo(intval($bulkNo), "GTN-");
$_SESSION["bulkNo"] = $bulkNo;
?>
<form class="regularForm" method="post" action="../connection/bulkingApproval.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/bulking.php";
  include "../forms/users.php";
  submitButton("Approve", "submit", "btnSubmit1");
  ?>
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
    <a href="../approval/bulkingList.php" class="btn btn-link" style="color:green">Back</a>
    <!-- <a href="../pdfgen/retrievedgrninfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a> -->
    </div>
</form>
<script>document.getElementById("print").style.display="none"</script>
<?php
include "../forms/footer.php";
include "../assets/js/bulking.php";
?>