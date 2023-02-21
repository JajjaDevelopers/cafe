<script>
    var ttQty = 0;
    var ttUsdAmt = 0;
    var ttUgxAmt = 0;
    <?php
    $i=1;
    while ($detSql->fetch()){
        ?>
        document.getElementById('item'+'<?=$i?>'+'Name').setAttribute("value", "<?=$grade?>");
        document.getElementById('item'+'<?=$i?>'+'Qty').setAttribute("value", "<?=$qty?>");
        document.getElementById('item'+'<?=$i?>'+'UsdPx').setAttribute("value", "<?=round($ugPx/$salFx,3)?>");
        document.getElementById('item'+'<?=$i?>'+'UgxPx').setAttribute("value", "<?=round($ugPx,0)?>");
        document.getElementById('item'+'<?=$i?>'+'UsdAmount').setAttribute("value", "<?=round($ugPx*$qty/$salFx,2)?>");
        document.getElementById('item'+'<?=$i?>'+'UgxAmount').setAttribute("value", "<?=round($ugPx*$qty,2)?>");
        ttQty += Number("<?=$qty?>");
        ttUsdAmt += Number("<?=$ugPx*$qty/$salFx?>");
        ttUgxAmt += Number("<?=$ugPx*$qty?>");
        <?php
        $i+=1;
    }
    ?>
    document.getElementById("totalQty").setAttribute("value", ttQty);
    document.getElementById("usdGrandTotal").setAttribute("value", ttUsdAmt);
    document.getElementById("ugxGrandTotal").setAttribute("value", ttUgxAmt);

    var readList = ["salesReportNumber", "salesReportDate", "exchangeRate", "catName", "salesReportCategory", "currName", 
                    "salesReportCurrency", "salesReportNotes"];
    for (var x=0;x<readList.length; x++){
        document.getElementById(readList[x]).setAttribute("readonly", "readonly");
    }
    var hideList = ["salesReportCategory", "salesReportCurrency", "salesReportBuyer"];
    for (var x=0;x<hideList.length;x++){
        document.getElementById(hideList[x]).style.display="none";
    }
    for (var x=1; x<=10; x++){
        document.getElementById('item'+x+'Select').style.display="none";
        //document.getElementById('item'+x+'Select')
    }
    for (var x=1; x<=10; x++){
        document.getElementById('item'+x+'Qty').setAttribute("readonly", "readonly");
        document.getElementById('item'+x+'UsdPx').setAttribute("readonly", "readonly");
        document.getElementById('item'+x+'UgxPx').setAttribute("readonly", "readonly");
    }
    document.getElementById("print").style.display="none";
</script>