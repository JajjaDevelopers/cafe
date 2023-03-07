<?php
$pageTitle="Valuation Report";
include("../forms/header.php");
if(isset($_GET['valNo'])){
    $val=$_GET['valNo'];
    $_SESSION["valNo"] = $val;
}
include "../connection/valuationVariables.php";
// include "../pdfgen/valuationVariables.php";
include ("../connection/databaseConn.php");

?>
<form class="regularForm" method="post" action="../connection/valuationVerification.php" style="height:fit-content; width:900px">
    <?php include "../templates/valuation.php" ?>
    <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/valuationList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/valuationinfo.php" target="_blank" class="btn btn-link" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
</form>
<?php
include "../assets/js/valuationVer.php"
?>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php include "../forms/footer.php" ?>


