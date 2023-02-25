<script>
    var x=1;
    var ttQty=0;
    <?php 
    while($detSql->fetch()){
        ?>
        if (Number("<?=$grdQty?>")>0){
            document.getElementById("item"+x+"Name").setAttribute("value", "<?=$grdName?>");
            document.getElementById("item"+x+"Qty").setAttribute("value", "<?=$grdQty?>");
            ttQty += Number("<?=$grdQty?>");
            x+=1;
        }
        <?php
    } 
    ?>
    document.getElementById("totalQty").setAttribute("value", ttQty);
    var disabledList = ["fromClientSelect", "toClientSelect", "fromWitnessName", "toWitnessName", "notes", "transferDate"];
    for (var x=0;x<disabledList.length;x++){
        document.getElementById(disabledList[x]).setAttribute('disabled','disabled');
    }
    var noDispalay = ["fromClientSelect", "toClientSelect"];
    for (var x=0;x<noDispalay.length;x++){
        document.getElementById(noDispalay[x]).style.display='none';
    }
    for (var x=1;x<=5;x++){
        document.getElementById('item'+x+'Select').setAttribute('disabled','disabled');
        document.getElementById('item'+x+'Select').style.display='none';
        document.getElementById('item'+x+'Bags').setAttribute('readonly','readonly');
        document.getElementById('item'+x+'Mc').setAttribute('readonly','readonly');
        document.getElementById('item'+x+'Qty').setAttribute('readonly','readonly');
    }
    
</script>
