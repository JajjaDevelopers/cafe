<?php $pageTitle="Verify Release"; ?>
<?php include("../forms/header.php");?>
<?php include "../connection/valuationVariables.php";?>
<?php include ("../connection/databaseConn.php");?>

<form class="regularForm" style="height:fit-content; width:900px">
    <?php include "../templates/valuation.php" ?>
    <?php submitButton("Verify", "submit", "btnSubmit") ?>
</form>
<?php include "../forms/footer.php" ?>
<script>
    var faqKg = Number(document.getElementById("FAQQty").value);
    var nameList = [];
    var yieldList = [];
    var qtyList = [];
    var usPxList = [];
    var ctsPxList = [];
    var ugxPxList = [];
    var usAmtList = [];
    var ugxAmtList = [];
    for (var x=1; x<=10; x++){
        var grdVar = 'highGrade'+x;
        nameList.push(grdVar+'Name');
        yieldList.push(grdVar+'Yield');
        qtyList.push(grdVar+'Qty');
        usPxList.push(grdVar+'PriceUs');
        ctsPxList.push(grdVar+'PriceCts');
        ugxPxList.push(grdVar+'PriceUgx');
        usAmtList.push(grdVar+'AmountUs');
        ugxAmtList.push(grdVar+'AmountUgx');
    }
    var i=0;
    var ttYield = 0;
    var ttQty = 0;
    var ttUsAmt = 0;
    var ttUgxAmt = 0;
    <?php
    while($valDetSql->fetch()){
        ?>
        
        var qty = Number("<?=$grdQty?>");
        if (qty>0){
            document.getElementById(nameList[i]).setAttribute("value", "<?=$grdName?>");
            document.getElementById(qtyList[i]).setAttribute("value", "<?=$grdQty?>");
            document.getElementById(yieldList[i]).setAttribute("value", <?=round($grdQty*100/$inputQty, 2)?>);
            document.getElementById(usPxList[i]).setAttribute("value", "<?= round($ugxPx/$fxRate,2) ?>");
            document.getElementById(ugxPxList[i]).setAttribute("value", "<?=$ugxPx?>");
            document.getElementById(ctsPxList[i]).setAttribute("value", "<?=round($ugxPx/$fxRate/0.022046,3)?>");
            document.getElementById(usAmtList[i]).setAttribute("value", "<?= round(($ugxPx/$fxRate)*$grdQty,2)?>");
            document.getElementById(ugxAmtList[i]).setAttribute("value", "<?=$ugxPx*$grdQty?>");
            ttYield += <?=round($grdQty*100/$inputQty, 2)?>;
            ttQty += <?=$grdQty?>;
            ttUsAmt += <?= round(($ugxPx/$fxRate)*$grdQty,2)?>; 

            i+=1;
        }
        <?php
    }
    ?>
    
       
    

</script>