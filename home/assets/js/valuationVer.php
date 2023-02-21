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
    var itmSelectList = [];
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
        itmSelectList.push(grdVar+'Select');       
    }
    document.getElementById("salesReportBuyer").style.display="none";
    var inactiveList = ["valuationDate", "batchNo", "totalCostsUgx", "costsDetails"];
    var allLists = [nameList, yieldList, qtyList, usPxList, ctsPxList, ugxPxList, usAmtList, ugxAmtList, inactiveList];
   
    for (var x=0; x<allLists.length; x++){
        for (var i=0; i<allLists[x].length; i++){
            document.getElementById(allLists[x][i]).setAttribute("readonly", "readonly");
            document.getElementById(itmSelectList[i]).style.display="none";
        }
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
            ttUgxAmt += <?=$ugxPx*$grdQty?>;
            i+=1;
        }
        <?php
    }

    ?>
    document.getElementById("grandTotaltUgx").setAttribute("value", ttUgxAmt);
    document.getElementById("totalValueUgx").setAttribute("value", ttUgxAmt-<?=$valCosts?>);
    document.getElementById("print").style.display="none";
</script>