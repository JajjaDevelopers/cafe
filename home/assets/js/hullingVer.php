<script>
    document.getElementById("inputName").setAttribute("value", "<?=$grdIn?>");
    var readonlyList = ["hullingDate", "inputMc", "outputMc", "notes", "inputQty"];
    for (var x=0;x<readonlyList.length; x++){
        document.getElementById(readonlyList[x]).setAttribute("readonly", "readonly");
    }
    var invisible = ["salesReportBuyer", "input", "output", "husks", "otherLoss"];
    for (var x=0; x<invisible.length; x++){
        document.getElementById(invisible[x]).style.display="none";
    }
    
    <?php
    $outputIds = array("outputName", "husksName", "otherLossName");
    $outQtyIds = array("outputQty", "husksQty", "otherLossQty");
    $outBagsIds = array("outputBags", "husksBags", "otherLossBags");
    $i=0;
    while ($outSql->fetch()){
        ?>
        document.getElementById("<?=$outputIds[$i]?>").setAttribute("value", "<?=$outGrdName?>");
        document.getElementById("<?=$outQtyIds[$i]?>").setAttribute("value", "<?=$outGrdQty?>");
        document.getElementById("<?=$outBagsIds[$i]?>").setAttribute("value", "<?=round($outGrdQty/60,0)?>");

        document.getElementById("<?=$outQtyIds[$i]?>").setAttribute("readonly", "readonly");
        <?php
        $i+=1;
    }
    $outSql->close();
    ?>
    document.getElementById("print").style.display="none";
</script>