<script>
    var grdNo = 1;
    <?php
    while ($detSql->fetch()){
        ?>
        document.getElementById("item"+grdNo+"Name").setAttribute("value", "<?=$grdName?>");
        document.getElementById("item"+grdNo+"Qty").setAttribute("value", "<?=$grdQty?>");
        grdNo+=1;
        <?php
    }
    ?>
    document.getElementById("totalQty").setAttribute("value", "<?=$ttQty?>");
    for (var x=1;x<=5;x++){
        document.getElementById('item'+x+'Select').setAttribute('disabled','disabled');
        document.getElementById('item'+x+'Select').style.display='none';
        document.getElementById('item'+x+'Bags').setAttribute('readonly','readonly');
        document.getElementById('item'+x+'Mc').setAttribute('readonly','readonly');
        document.getElementById('item'+x+'Qty').setAttribute('readonly','readonly');
    }

    var noDispalay = ["bulkOutGrd", "salesReportBuyer"];
    for (var x=0;x<noDispalay.length;x++){
        document.getElementById(noDispalay[x]).style.display='none';
    }
   
    
    var noEditList =["bulkingDate", "notes"];
    for (var x=0;x<noEditList.length;x++){
        document.getElementById(noEditList[x]).setAttribute('readonly', 'readonly')
    }

</script>