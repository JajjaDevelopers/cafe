<?php $pageTitle="Delivery Note"; ?>
<?php include("../forms/header.php"); ?>
<?php include "../connection/releaseVariables.php"; ?>

<form class="regularForm" method="POST" action="../connection/dispatch.php" style="height:fit-content; width:800px">
    <input id="releaseNo" name="releaseNo" style="display: none;" value="<?= $releaseNo ?>" readonly>
    <?php require "../templates/releaseTemplate.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <label for="truckNo">Truck Reg No.</label><br>
                <input id="truckNo" name="truckNo" class="shortInput" maxlength="7" required>
            </div>
            <div class="col-md-4">
                <label for="driverName">Driver's Name</label><br>
                <input id="driver" name="driver" class="shortInput" style="width: 300px;" required>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
    </div>
    <?php submitButton("Dispatch", "submit", "confirm"); ?>
</form>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById("deliveryNoteHeading").innerHTML = "Delivery Note";
    document.getElementById("customerId").setAttribute("value", "<?=$custId?>");
    document.getElementById("customerName").setAttribute("value", "<?=$custName?>");
    document.getElementById("salesReportContact").setAttribute("value", "<?=$ctctPersn?>");
    document.getElementById("salesReportTel").setAttribute("value", "<?=$tel?>");
    document.getElementById("relDate").setAttribute("value", "<?=$relsDate?>");
    //non displaying
    document.getElementById("salesReportBuyer").style.display = "none";
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