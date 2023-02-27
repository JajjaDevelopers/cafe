<?php $pageTitle = "Bulking Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/bulkingVariables.php";?>
<?php
$bulkingNo = formatDocNo(intval($bulkNo), "BLK-");
$_SESSION["bulkNo"] = $transNo;
?>
<form class="regularForm" style="height: fit-content; width:790px">
  <?php
  include "../templates/bulking.php";
  include "../forms/users.php";
  ?>
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
    <a href="../transactions/bulkingList.php" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/retrievedgrninfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
</form>
<?php
include "../forms/footer.php";
include "../assets/js/bulking.php";
?>

