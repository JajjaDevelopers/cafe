<?php $pageTitle = "Drying Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/dryingVariables.php";?>
<?php
$grnNo = formatDocNo(intval($grn_no), "GRN-");
$_SESSION["dryNo"] = $dryNo;
?>
<form class="regularForm" method="post" action="../connection/dryingApproval.php" style="height: fit-content; width:790px">

  <?php
  include "../templates/drying.php";
  submitButton("Approve", "submit", "btnSubmi");
  ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../approval/dryingList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/retrievedgrninfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<?php
include "../forms/footer.php";
include "../assets/js/drying.php";
?>
