<?php $pageTitle = "TRANSFER REPORT";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/dryingVariables.php";
if(isset($_GET['transNo'])){
  $trans=$_GET['transNo'];
  $_SESSION["transNo"] = $trans;
}
?>

<form class="regularForm" style="height: fit-content; width:790px">
  <?php
  include "../templates/transfer.php";
  include "../forms/users.php";
  ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/transferList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/transferinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<?php
include "../forms/footer.php";
include "../assets/js/drying.php";
?>
