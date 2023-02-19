<h3 class="formHeading">HULLING REPORT</h3>
<?php
include "../alerts/message.php";
?>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <input name="hullNo" value="<?= $hullNo?>" readonly style="display:none">
    <label for="hullingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Hulling No:</label>
    <input type="text" class="shortInput" id="hullingNo" name="hullingNo" value="<?= $hullingNo?>" readonly style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="hullingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="hullingDate" name="hullingDate" value="<?=$hulDate?>" style="grid-column: 2; grid-row: 2">
</div>
<?php include("../forms/customerSelector.php") ?>
<div style="margin-top: 10px">
    <label for="inputMc">Input MC</label>
    <input type="number" value="<?=$mcIn?>" id="inputMc" name="inputMc" class="shortInput" min="10" max="18" step="0.01">
    <label for="outputMc" style="margin-left: 70px;">Output MC</label>
    <input type="number" value="<?=$mcOut?>" id="outputMc" name="outputMc" class="shortInput" min="10" max="18" step="0.01">
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
        $details = array("Input", "Output", "", "");
        $detValues = array($grdIn, $grdOut, $grdOut,$grdOut,);
        $qtyValues = array($qtyIn, $qtyOut, $qtyOut,$qtyOut,);
        for ($i=0; $i<count($detailsId); $i++){
        ?>
        <tr>
            <td><label><?= $details[$i]?></label></td>
            <td><?php gradePicker($detailsId[$i], $detailsId[$i])?></td>
            <td><input type="number" value="<?=$qtyValues[$i]?>" id="<?= $detailsId[$i].'Qty'?>" name="<?= $detailsId[$i].'Qty'?>" class="tableInput" step="0.01" style="text-align: right;"></td>
            <td><input type="number" readonly value="<?=round($qtyValues[$i]/60,0)?>" id="<?= $detailsId[$i].'Bags'?>" name="<?= $detailsId[$i].'Bags'?>" class="tableInput" step="0.1" style="text-align: right;"></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td style="display:none" colspan="2">Total</td>
            <td style="display:none"><input type="number" value="" id="totalQty" readonl+y name="totalQty" class="tableInput" step="0.01"></td>
            <td style="display:none"><input type="number" value="" id="totalBags" readonly name="totalBags" class="tableInput" step="0.1"></td>
        </tr>
    </table>
</div>
<?php documentNotes("700px") ?>
<?php include("../forms/users.php") ?>


