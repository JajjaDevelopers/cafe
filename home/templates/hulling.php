<h3 class="formHeading">HULLING REPORT</h3>
<?php
include "../alerts/message.php";
?>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <input name="hullNo" value="<?= $hullNo?>" readonly style="display:none">
    <label for="hullingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Hulling No:</label>
    <input type="text" class="shortInput" id="hullingNo" name="hullingNo" value="<?= $hullingNo?>" readonly style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="hullingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="hullingDate" name="hullingDate" value="<?=$hulDate?>" style="grid-column: 2; grid-row: 2" readonly>
</div>
<?php include("../forms/customerSelector.php") ?>
<div style="margin-top: 10px">
    <label for="inputMc">Input MC</label>
    <input type="number" value="<?=$mcIn?>" id="inputMc" name="inputMc" class="shortInput" min="10" max="18" step="0.01" readonly>
    <label for="outputMc" style="margin-left: 70px;">Output MC</label>
    <input type="number" value="<?=$mcOut?>" id="outputMc" name="outputMc" class="shortInput" min="10" max="18" step="0.01" readonly>
</div>
<div style="margin-top: 10px;">
<table>
            <tr>
                <th style="width: 100px;">Details</th>
                <th style="width: 300px;">Grade</th>
                <th style="width: 100px;">Qty (Kg)</th>
                <!-- <th style="width: 70px;">Moisture</th> -->
            </tr>
            <tr>
                <td><label>Input</td>
                <td><?=$grdName?></td>
                <td><input type="text" value="<?=num($qtyIn)?>" id="inputQty" name="inputQty" class="tblNum" readonly></td>
            </tr>
            <?php outputDetails() ?>
            
        </table>
</div>
<?php documentNotes("700px") ?>
<?php include("../forms/users.php") ?>
<script>
    document.getElementById("salesReportBuyer").style.display="none";
    document.getElementById("notes").setAttribute("readonly", "readonly");
</script>



