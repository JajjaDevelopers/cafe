<h3 id="activitySheetHeading" class="formHeading">Roasting Activity Sheet</h3>
<div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="rostingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Activity No:</label>
    <input type="text" class="shortInput" id="rostingNo" name="rostingNo" value="<?= $activityNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="rostingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="rostingDate" name="rostingDate" value="<?= $actDate?>" readonly style="grid-column: 2; grid-row: 2">
</div>
<?php include("../forms/customerSelector.php") ?>

<div id="servicesTable" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12"><label for="inputQty">Input</label></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label for="inputGrade">Input Grade</label>
                <input id="inputGrade" name="inputGrade" value="<?=$inputGrd?>" readonly class="shortInput" style="width: 250px;">
                <label for="inputQty" style="padding-left: 20px;" >Quantity</label>
                <input type="text" id="inputQty" name="inputQty" value="<?=num($inputQty)?>" readonly class="shortInput" style="text-align: right;">
            </div>
        </div>
    </div>
    <h5>Activities</h5>
    <?php itemDetails(); ?>
</div>
<table style="margin-top: 30px; width: 100%">
    <tr>
        <th>Special Requests</th>
        <th>Coffee Roast Profile</th>
    </tr>
    <tr>
        <td><input type="text" id="specialRequest" value="<?=$specailRequest?>" readonly class="remarks" name="specialRequest"></td>
        <td><input type="text" id="roastProfile" value="<?=$roastProfile?>" readonly class="remarks" name="roastProfile"></td>
    </tr>
</table>