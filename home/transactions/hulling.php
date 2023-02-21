<?php $pageTitle="Hulling Report"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/hullingVariables.php";?>
<?php include ("../connection/databaseConn.php");
    if(isset($_GET['hullNo'])){
        $hull=$_GET['hullNo'];
        $_SESSION["hullNo"] = $hull;
    }
?>


<form class="regularForm" style="height:fit-content; width:800px">
    <?php include "../templates/hulling.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/hullingList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/hullinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php include "../forms/footer.php" ?>
<?php include("../assets/js/hullingVer.php") ?>