<h3 class="formHeading">Stock Adjustment</h3>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="adjNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Adjust No:</label>
    <input type="text" class="shortInput" id="adjNo" name="adjNo" readonly value="<?= $adjNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="adjDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="adjDate" name="adjDate" value="<?= $fmDate?>" style="grid-column: 2; grid-row: 2;" required>
</div>
<?php include("../forms/customerSelector.php") ?>
<?php itemsTable(5, "Stock Adjustment Items"); ?>
<?php documentNotes("700px") ?>