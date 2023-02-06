<?php $pageTitle = "GRN";?>
<?php include "../forms/header.php" ?>
<?php include "../private/database.php"?>
<?php include "../connection/verifyGrn.php";?>
<?php
$grnNo = formatDocNo(intval($grn_no), "GRN-");
?>
<form class="regularForm" style="height: fit-content; width:1000px">

  <?php include "../forms/grnTemplate.php" ?>
</form>

<?php include "../forms/footer.php" ?>
<script>
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
    
</script>