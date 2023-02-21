<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/releaseVariables.php" ?>
<?php include ("../connection/databaseConn.php");

if(isset($_GET['relNo'])){
    $rel=$_GET['relNo'];
    $_SESSION["relNo"] = $rel;
}
?>

<form class="regularForm" style="height:fit-content; width:800px">
<input id="releaseNo" name="releaseNo" value="<?=$releaseNo?>" style="display:none" readonly>
<?php require "../templates/releaseTemplate.php" ?>
</form>
<div class=" mt-3 me-5 d-flex flex-row justify-content-between">
<a href="../transactions/releaseList" class="btn btn-link" style="color:green">Back</a>
    <a href="../pdfgen/dispatchinfo.php" target="_blank" class="" id="pdf" style="display:block;">
        <i class="bi bi-download" style="color:green; font-size:30px">
        </i>
    </a>
</div>
<script>
  document.getElementById("print").style.display="none";
</script>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById("customerId").setAttribute("value", "<?=$custId?>");
    document.getElementById("customerName").setAttribute("value", "<?=$custName?>");
    document.getElementById("salesReportContact").setAttribute("value", "<?=$ctctPersn?>");
    document.getElementById("salesReportTel").setAttribute("value", "<?=$tel?>");
    document.getElementById("salesReportTel").setAttribute("value", "<?=$tel?>");
    document.getElementById("relDate").setAttribute("value", "<?=$relsDate?>");
    //non displaying
    var noDispList = ["salesReportBuyer", "dispNoLabel", "dispNo"];
    for (var x=0; x<noDispList.length; x++){
        document.getElementById(noDispList[x]).style.display = "none";
    }
    var noEditList = ["initiator", "remarks", "destination", "relDate"];
    for (var x=0; x<noEditList.length; x++){
        document.getElementById(noEditList[x]).setAttribute("readonly", "readonly");
    }
    for (var x=1; x<=10; x++){
        document.getElementById('item'+x+'Select').style.display = "none";
        document.getElementById('item'+x+'Qty').setAttribute("readonly", "readonly");
    }
    //item table
    <?php
        $x=1;
        $qtySum = 0;
        while ($relDetSql->fetch()){
            ?>
            document.getElementById("<?='item'.$x.'Id'?>").setAttribute("value", "<?=$grdId?>")
            document.getElementById("<?='item'.$x.'Name'?>").setAttribute("value", "<?=$grdName?>")
            document.getElementById("<?='item'.$x.'Qty'?>").setAttribute("value", "<?=$qty?>")
            <?php
            $qtySum += $qty;
            $x += 1;
        }
    ?>
    document.getElementById("totalQty").setAttribute("value", "<?=$qtySum?>");
    


</script>