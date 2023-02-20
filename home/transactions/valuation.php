<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/valuationVariables.php";?>
<?php include ("../connection/databaseConn.php");
if(isset($_GET['valNo'])){
    $val=$_GET['valNo'];
    $_SESSION["valNo"] = $val;
}
?>
<form class="regularForm" method="post" action="../connection/valuationVerification.php" style="height:fit-content; width:900px">
    <?php include "../templates/valuation.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/valuationList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/valuationinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<?php include "../forms/footer.php" ?>
<?php include "../assets/js/valuationVer.php" ?>