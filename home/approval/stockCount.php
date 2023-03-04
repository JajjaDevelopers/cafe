<?php $pageTitle = "Stock Adjustment Report";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/stockCountingVariables.php";?>
<?php
if(isset($_GET['countNo'])){
  $countvariable=$_GET['countNo'];
  // $_SESSION["dryNo"] = $dry;
  $_SESSION["countNo"] = $countvariable;
}
?>
<form class="regularForm" method="post" action="../connection/stockCountApproval.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/stockCount.php";
  include "../forms/users.php";
  submitButton("Approve", "submit", "btnSubmit");
  ?>
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
    <a href="../verification/stockCountList.php" class="btn btn-link" style="color:green">Back</a>
    <!-- <a href="../pdfgen/adjustinfo.php" target="_blank" class="" id="pdf" style="display:block;">
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
?>
<script>
    var noDispalay = ["salesReportBuyer"];
    for (var x=0;x<noDispalay.length;x++){
        document.getElementById(noDispalay[x]).style.display='none';
    }
   
    
    var noEditList =["stkCountDate", "notes"];
    for (var x=0;x<noEditList.length;x++){
        document.getElementById(noEditList[x]).setAttribute('readonly', 'readonly')
    }

</script>


