<?php $pageTitle="Activity Sheet"; ?>
<?php include_once('../forms/header.php'); ?>
<?php
include ("../connection/databaseConn.php");
$activityNo = nextDocNumber("roastery_activity_summary", "activity_sheet_no", "RST");
?>

<form class="regularForm" action="../connection/activitySheet.php" method="POST" style="height: fit-content;">
   
    <h3 id="activitySheetHeading" class="formHeading">Roasting Order Form</h3>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="rostingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Activity No:</label>
        <input type="text" class="shortInput" id="rostingNo" name="rostingNo" value="<?= $activityNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="rostingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="rostingDate" name="rostingDate" value="<?= $today?>" style="grid-column: 2; grid-row: 2">
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
                    <select id="inputGrade" name="inputGrade" class="shortInput" style="width: 250px;">
                        <?php coffeeGrades(); ?>
                    </select>
                    <label for="inputQty" style="padding-left: 20px;" >Quantity</label>
                    <input type="number" id="inputQty" name="inputQty" class="shortInput" step="0.01">
                </div>
            </div>
        </div>
        <h5>Activities</h5>
        <table>
            <thead>
                <tr>
                    <th style="width: 330px;">Activity Name</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Rate</th>
                    <th style="width: 150px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for ($row = 1; $row <= 10; $row ++){
                        activityServices($row);
                    }
                ?>
            
                <tr id="totalRow">
                    <td class="emptyCell"></td>
                    <td class="emptyCell"></td>
                    <th>Total</th>
                    <th><input type="text" id="totalAmount" name="totalAmount" class="tblNum" readonly></th>
                </tr>
            </tbody>
        </table>
    </div>

    <div  id="inventoryTable" style="display: none;">
        <h5>Output Items</h5>
        <table>
            <thead>
                <tr>
                    <th style="width: 400px;">Item Name</th>
                    <th style="width: 100px;">Unit</th>
                    <th style="width: 150px;">Output Qty</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                for ($row = 1; $row <= 10; $row ++){ //script for creating items should be adjusted to match $row value
                    activitySheetItems($row);
                }
            ?>
            </tbody>
        </table>
    </div>

    <table style="margin-top: 30px; width: 100%">
        <tr>
            <th>Special Requests</th>
            <th>Coffee Roast Profile</th>
        </tr>
        <tr>
            <td><input type="text" id="specialRequest" class="remarks" name="specialRequest"></td>
            <td><input type="text" id="roastProfile" class="remarks" name="roastProfile"></td>
        </tr>
    </table>
    <div style="display: grid;">
        <div id="previousButton" style="grid-column: 1; grid-row: 1; display: none">
            <!-- <input type="button" value="Back" class="btn  btn-primary my-3 btn-md text-white" name="btnsubmit"> -->
            <?php submitButton("Back", "button", "btnsubmit") ?>
        </div>
        <div id="nextButton" style="grid-column: 2; grid-row: 1;">
            <!-- <input type="button" value="Next" class="btn  btn-primary my-3 btn-md text-white" name="btnsubmit"> -->
            <?php submitButton("Next", "button", "btnsubmit") ?>
        </div>
        <div id="submitButton" style="grid-column: 2; grid-row: 1; display: none">
            <?php submitButton("Submit", "submit", "btnsubmit") ?>
        </div>
    </div>
</form>
<?php include_once('../forms/footer.php'); ?>
<script src="../assets/js/activitySheet.js"></script>

