<?php $pageTitle = "Bulking Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/bulkingVariables.php";?>
<?php
$bulkingNo = formatDocNo(intval($bulkNo), "BLK-");
if(isset($_GET['bulkNo'])){
  $bulkvariable=$_GET['bulkNo'];
  // $_SESSION["dryNo"] = $dry;
  $_SESSION["bulkNo"] = $bulkvariable;
}
?>
<form class="regularForm" style="height: fit-content; width:790px">
  <?php
  include "../templates/bulking.php";
  include "../forms/users.php";
  ?>
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
    <a href="../transactions/bulkingList.php" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/bulkinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
</form>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php
include "../forms/footer.php";
include "../assets/js/bulking.php";
?>

