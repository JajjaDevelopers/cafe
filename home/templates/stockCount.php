<h3 class="formHeading">Stock Counting</h3>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="stkCountNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Count No:</label>
    <input type="text" class="shortInput" id="stkCountNo" name="stkCountNo" readonly value="<?= $stkCountNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="stkCountDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">As at:</label>
    <input type="date" class="shortInput" id="stkCountDate" name="stkCountDate" readonly value="<?= $fmDate?>" style="grid-column: 2; grid-row: 2;" required>
</div>
<?php 
include("../forms/customerSelector.php");
 stockCountDetails();
//include "../ajax/stockCountItems.php";
documentNotes("700px"); 
?>
