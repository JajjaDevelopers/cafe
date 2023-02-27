<script>
    var itm = 1;
    <?php
    while ($detSql->fetch()){
        ?>
        document.getElementById('item'+itm+'Name').setAttribute('value', '<?=$grdName?>');
        var qtyIn = Number('<?=$qtyIn?>');
        var qtyOut = Number('<?=$qtyOut?>');
        if (qtyIn>0){
            document.getElementById('item'+itm+'Qty').setAttribute('value', qtyIn);
        }else if (qtyOut>0){
            document.getElementById('item'+itm+'Qty').setAttribute('value', -qtyOut);
        }
        itm+=1;
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
    document.getElementById("salesReportBuyer").style.display='none';
    var noEditList =["adjDate", "notes"];
    for (var x=0;x<noEditList.length;x++){
        document.getElementById(noEditList[x]).setAttribute('readonly', 'readonly')
    }
</script>