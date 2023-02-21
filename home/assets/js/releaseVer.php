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
    document.getElementById("print").addEventListener("click",()=>{
      // alert("Hi God");
      document.getElementById("print").style.display="none";
      window.print();
      document.getElementById("print").style.display="block";
    })   
</script>