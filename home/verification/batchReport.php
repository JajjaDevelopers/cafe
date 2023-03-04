<?php $pageTitle = "Batch Report";
include "../forms/header.php";
include "../connection/databaseConn.php";
// include ("../ajax/batchReportReturnsAjax.php");
// include "../connection/batchReportVariables.php";
include "../connection/batchHistVariables.php";

if(isset($_GET['batchNo'])){
  $batchNo=$_GET['batchNo'];
  // $_SESSION["dryNo"] = $dry;
  $_SESSION["batchNo"] = $batchNo;
}
?>
<form class="regularForm" method="post" action="../connection/batchReportVerification.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/batchReport.php";
  include "../forms/users.php";
  submitButton("Verify", "submit", "btnSubmit");
  ?>
  <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
  <a href="../verification/batchReportList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
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


