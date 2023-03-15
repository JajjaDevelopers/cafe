<?php $pageTitle="Hulling"; ?>
<?php require ("../forms/header.php") ?>
<?php include ("../connection/databaseConn.php");
$hullingNo = nextDocNumber("hulling", "hulling_no", "HLP"); 
?>
<form id="hullingForm" name="hullingForm" class="regularForm" style="height:auto;" method="POST" action="../connection/hulling.php">
    <h3 class="formHeading">HULLING REPORT</h3>
    <?php
    include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="hullingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Hulling No:</label>
        <input type="text" class="shortInput" id="hullingNo" name="hullingNo" value="<?= $hullingNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="hullingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="hullingDate" name="hullingDate" value="<?= $today?>" style="grid-column: 2; grid-row: 2">
    </div>
    <?php include("../forms/customerSelector.php") ?>
    <div style="margin-top: 10px">
        <label for="inputMc">Input MC</label>
        <input type="number" value="" id="inputMc" name="inputMc" class="shortInput" min="10" max="18" step="0.01">
        <label for="outputMc" style="margin-left: 70px;">Output MC</label>
        <input type="number" value="" id="outputMc" name="outputMc" class="shortInput" min="10" max="18" step="0.01">
    </div>
    <div style="margin-top: 10px;">
        <table>
            <tr>
                <th style="width: 150px;">Details</th>
                <th>Grade</th>
                <th style="width: 100px;">Qty (Kg)</th>
                <th style="width: 100px;">Bags</th>
                <!-- <th style="width: 70px;">Moisture</th> -->
            </tr>
            <?php
            $detailsId = array("input", "output", "husks", "otherLoss");
            $details = array("Input", "Output", "Husks", "Other Loss");
            $detailsValues = array("", "", "GHUSKS", "");
            for ($i=0; $i<count($detailsId); $i++){
            ?>
            <tr>
                <td><label><?= $details[$i]?></label></td>
                <td><?php gradePicker($detailsId[$i], $detailsId[$i])?></td>
                <td><input type="number" value="" id="<?= $detailsId[$i].'Qty'?>" name="<?= $detailsId[$i].'Qty'?>" class="tableInput" step="0.01"></td>
                <td><input type="number" readonly value="" id="<?= $detailsId[$i].'Bags'?>" name="<?= $detailsId[$i].'Bags'?>" class="tableInput" step="0.1"></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="2">Total</td>
                <td><input type="number" value="" id="totalQty" readonly name="totalQty" class="tableInput" step="0.01"></td>
                <td><input type="number" value="" id="totalBags" readonly name="totalBags" class="tableInput" step="0.1"></td>
            </tr>
        </table>
    </div>
    <?php documentNotes("700px") ?>


    <?php submitButton("Submit", "submit", "btnsubmit"); ?>
</form>
<?php require ("../forms/footer.php") ?>
<script src="../assets/js/gradePicker.js"></script>
<script>
    var detailsId = ["input", "output", "husks", "otherLoss"];
    var qtyIds = [];
    var bagsIds = [];
    for (var x=0; x<detailsId.length; x++){
        qtyIds.push(detailsId[x]+"Qty");
        bagsIds.push(detailsId[x]+"Bags");
        document.getElementById(qtyIds[x]).addEventListener("blur", getBagsNo);
    }
    document.getElementById(qtyIds[3]).setAttribute("readonly", "readonly");
    document.getElementById(bagsIds[3]).setAttribute("readonly", "readonly");
    function getBagsNo(){
        var totalQty = 0;
        var totalBags = 0;
        for (var i=0; i<qtyIds.length; i++){
            var qty = document.getElementById(qtyIds[i]).value;
            var bags = qty/60;
            totalQty += Number(qty);
            totalBags += Number(bags);
            document.getElementById(bagsIds[i]).setAttribute("value", bags);
        }
        var inputQty = document.getElementById(qtyIds[0]).value;
        var outputQty = document.getElementById(qtyIds[1]).value;
        var huskstQty = document.getElementById(qtyIds[2]).value;
        var otherLossQty = inputQty-outputQty-huskstQty;
        document.getElementById("totalQty").setAttribute("value", inputQty);
        document.getElementById("totalBags").setAttribute("value", inputQty/60);
        document.getElementById(qtyIds[3]).setAttribute("value", otherLossQty);
        document.getElementById(bagsIds[3]).setAttribute("value", otherLossQty/60);
    }

</script>

