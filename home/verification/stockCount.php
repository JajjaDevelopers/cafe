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
<form class="regularForm" method="post" action="../connection/stockCountVerification.php" style="height: fit-content; width:790px">
  <?php
  include "../templates/stockCount.php";
  include "../forms/users.php";
  submitButton("Verify", "submit", "btnSubmit");
  ?>
  <a href="../verification/stockCountList.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
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


