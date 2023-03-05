<?php $pageTitle = "Stock Counting" ?>
<?php include "../forms/header.php" ?>
<?php 
include ("../connection/databaseConn.php");
$stkCountNo = nextDocNumber("stock_counting", "count_no", "STC"); 
?>
<form class="regularForm" method="post" action="../connection/stockCounting.php" style="height: fit-content;">
    <h3 class="formHeading">Stock Counting</h3>
    
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="stkCountNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Count No:</label>
        <input type="text" class="shortInput" id="stkCountNo" name="stkCountNo" readonly value="<?= $stkCountNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="stkCountDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">As at:</label>
        <input type="date" class="shortInput" id="stkCountDate" name="stkCountDate" readonly value="" style="grid-column: 2; grid-row: 2;" required
        >
    </div>
    <?php include("../forms/customerSelector.php") ?>
    <?php include "../ajax/stockCountItems.php" ?>


    <?php comment("700px") ?>
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-6">
                <?php //submitButton("Back", "", "back") ?>
            </div> -->
            <div class="col-md-12">
                <?php submitButton("Submit", "submit", "btnsubmit") ?>
            </div>
        </div>
    </div>
    
</form>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById('stkCountDate').setAttribute("value", "<?= $selDate?>");
    document.getElementById('customerId').setAttribute("value", "<?= $client?>");
    document.getElementById('customerName').setAttribute("value", "<?= $cltName?>");
    document.getElementById('salesReportContact').setAttribute("value", "<?= $cltContact?>");
    document.getElementById('salesReportTel').setAttribute("value", "<?= '+256 '.$cltTel?>");
    document.getElementById('salesReportBuyer').style.display = 'none';
    //getting variance
    function getVariance(){
        var itmNo = Number(document.getElementById("grdNo").value);
        var ttAvailable = 0;
        var ttCount = 0;
        for (var x=1; x<=itmNo; x++){
            var available = Number(document.getElementById('itm'+x+'Available').value);
            ttAvailable += available;
            var counted = Number(document.getElementById('itm'+x+'Count').value);
            ttCount += counted;
            document.getElementById('itm'+x+'Var').setAttribute("value", counted-available);
        }
        document.getElementById('totalAvailable').setAttribute("value", ttAvailable);
        document.getElementById('totalCount').setAttribute("value", ttCount);
        document.getElementById('totalVar').setAttribute("value", ttCount-ttAvailable);
        
    }
    getVariance();


</script>