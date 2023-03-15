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
    
    <?php
    

    ?>
    document.getElementById("totalQty").setAttribute("value", ttQty);
    document.getElementById("totalYield").setAttribute("value", ttYield);
    document.getElementById("totalCostsUsd").setAttribute("value", <?=num($valCosts/$fxRate)?>);
    document.getElementById("grandTotaltUgx").setAttribute("value", ttUgxAmt);
    document.getElementById("totalValueUgx").setAttribute("value", ttUgxAmt-<?=$valCosts?>);
    document.getElementById("grandTotaltUs").setAttribute("value", (ttUsAmt,2));
    document.getElementById("totalValueUsd").setAttribute("value", (ttUsAmt-Number("<?=$valCosts/$fxRate?>")));
</script>