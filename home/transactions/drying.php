<?php $pageTitle = "Drying";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/dryingVariables.php";
    if(isset($_GET['dryNo'])){
      $dry=$_GET['dryNo'];
      $_SESSION["dryNo"] = $dry;
  }
?>

<form class="regularForm" style="height: fit-content; width:790px">

  <?php include "../templates/drying.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/dryingList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/dryinginfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php
include "../forms/footer.php";
include "../assets/js/drying.php";
?>
