<?php $pageTitle="Hulling";
require ("../forms/header.php");
include ("../connection/databaseConn.php");
include "../connection/batchOrderSummary.php";
$hullingNo = nextDocNumber("hulling", "hulling_no", "HLP"); 
?>
<form id="hullingForm" name="hullingForm" class="regularForm" style="height:auto;" method="POST" action="../connection/hulling.php">
    <h3 class="formHeading">HULLING REPORT</h3>
    <?php
    include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="hullingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Hulling No:</label>
        <input type="text" class="shortInput" id="hullingNo" name="hullingNo" readonly value="<?= $hullingNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="hullingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="hullingDate" name="hullingDate" value="<?= $today?>" style="grid-column: 2; grid-row: 2">
        <label for="orderNo" class="" style="grid-column: 1; grid-row: 3; margin-top: 10px">Order No.:</label>
    <input type="number" class="shortInput" id="orderNo" name="orderNo" required readonly value="<?= $orderNo ?>" style="grid-column: 2; grid-row: 3">
    </div>
    <?php include("../forms/customerSelector.php") ?>
    <div style="margin-top: 10px">
        <label for="inputMc">Input MC</label>
        <input type="number" value="<?=$inMc?>" id="inputMc" name="inputMc" class="shortInput" min="10" max="18" step="0.01">
        <label for="outputMc" style="margin-left: 70px;">Output MC</label>
        <input type="number" value="<?=$inMc?>" id="outputMc" name="outputMc" class="shortInput" min="10" max="18" step="0.01">
    </div>
    <div style="margin-top: 10px;">
    <input value="<?=$grdId?>" name="inputCode" readonly style="display: none;">
        <table>
            <tr>
                <th style="width: 100px;">Details</th>
                <th style="width: 300px;">Grade</th>
                <th style="width: 100px;">Qty (Kg)</th>
                <!-- <th style="width: 70px;">Moisture</th> -->
            </tr>
            <tr>
                <td><label>Input</td>
                <input type="text" value="<?=$grdId?>" id="inputGrd" name="inputGrd" class="tblNum" step="0.01" style="display: none;">
                <td><?=$grdName?></td>
                <td><input type="number" value="<?=intval($inQty)?>" id="inputQty" name="inputQty" class="tblNum" step="0.01"></td>
            </tr>
            <tr>
                <td><label>Output:</td>
                <td>
                    <select type="text" id="outputGrd" name="outputGrd" class="tableInput" step="0.01" required>
                        <?php selectCoffeeGrades() ?>
                    </select></td>
                <td><input type="number" value="0" id="outputQty" name="outputQty" class="tblNum" step="0.01" onblur="updateQtyss()" required></td>
            </tr>
            <tr>
                <td>Husks</td>
                <td>
                    <select type="text" id="husksGrd" name="husksGrd" class="tableInput" step="0.01">
                        <option value="GHUSKS">Husks</option>
                    </select>
                </td>
                <td><input type="number" value="0" id="husksQty" name="husksQty" class="tblNum" step="0.01" onblur="updateQtyss()"></td>
            </tr>
            <tr>
                <td>Other Loss</td>
                <td>
                    <select type="text" id="otherLossGrd" name="otherLossGrd" class="tableInput" step="0.01" required>
                        <?php wastesAndLosses() ?>
                    </select>
                </td>
                <td><input type="number" value="0" id="otherLossQty" name="otherLossQty" class="tblNum" step="0.01" readonly></td>
            </tr>
            
        </table>
    </div>
    <?php documentNotes("700px") ?>


    <?php submitButton("Submit", "submit", "btnsubmit"); ?>
</form>
<?php require ("../forms/footer.php") ?>
<script src="../assets/js/hulling.js"></script>

