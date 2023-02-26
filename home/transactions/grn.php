<?php $pageTitle = "GRN";?>
<?php include "../forms/header.php" ?>
<?php include "../connection/databaseConn.php"?>
<?php include "../connection/verifyGrn.php";?>
<?php
$grnNo = formatDocNo(intval($grn_no), "GRN-");
if(isset($_GET["grnNo"])){
    $grnNumber = $_GET["grnNo"];
    $_SESSION["grn"] = $grnNumber;
}
?>
<form class="regularForm" style="height: fit-content; width:790px">

  <?php include "../templates/grnTemplate.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/grnList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/retrievedgrninfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById("print").style.display="none";
    document.getElementById("salesReportBuyer").style.display = "none";
    document.getElementById("customerName").value = "<?=$customer_name?>";
    document.getElementById("customerId").value = "<?=$customer_id?>";
    document.getElementById("salesReportContact").value = "<?=$contact_person?>";
    document.getElementById("salesReportTel").value = "<?= '+256'.$telephone?>";

    //disabling editing
    var noEditList = ["grnNo", "grnDate", "timeIn", "type", "gradeId", "weight", "bags", "mc", "purposeName", 
                    "origin", "deliveryPerson", "truckNumber", "driverName", "remarks", "gradeName", "typeName", 
                    "districtName", "regionName"];
    for (var x=0; x<noEditList.length; x++){
        document.getElementById(noEditList[x]).setAttribute("readonly", "readonly");
    }
    var noDisplayList = ["gradeId", "salesReportBuyer", "type", "purpose", "region", "origin", "category"];
    for (var x=0; x<noDisplayList.length; x++){
        document.getElementById(noDisplayList[x]).style.display = "none";
    }
  document.getElementById("print").style.display="none";
</script>