<?php $pageTitle="Direct Processing Order"; ?>
<?php include_once('../forms/header.php'); ?>
<?php include ("../connection/databaseConn.php"); ?>
  <!-- <div class="container"> -->
<div id="ajaxDiv1" style="display:none"></div>
<form class="regularForm" method="POST" style="height:fit-content; width:900px" action="../connection/batchProcessingOrder.php">
    <legend class="formHeading">Direct Batch Order</legend>
    <?php
        include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label for="grnNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Order No:</label>
        <input type="text" class="shortInput" id="orderNo" name="batchOrderNumber" required value="<?php echo nextDocNumber('batch_processing_order', 'batch_order_no', 'BPO-'); ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="orderDate" name="orderDate" value="<?= $today ?>" style="grid-column: 2; grid-row: 2">
    </div>
    <?php require "../forms/customerSelector.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <label>Activity:</label>
                <select id="activity" name="activity" class="shortInput" style="width: 200px;">
                    <option value="Grading">Grading and Color Sorting</option>
                    <option value="Hulling">Hulling</option>
                    <option value="Drying">Drying</option>
                </select>
            </div><br>
            <div class="col-sm-6">
                <label for="gradeLimit" style="grid-row: 1; margin-top: 5px">Input Grade</label>
                <select type="text" id="gradeLimit" name="gradeLimit" class="shortInput" style="width: 250px" required>
                    <?php selectCoffeeGrades(); ?>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-6">
                <label id="batchTotalQty">Input Qty:</label>
                <input type="number" value="" id="batchTotalQty" name="batchTotalQty" class="shortInput" min="1" step="0.01" style="text-align: right;"></td>
            </div>
            <div class="col-sm-6">
                <label id="avgMc">Avg MC (%):</label>
                <input type="number" value="" id="avgMc" name="avgMc" class="shortInput" step="0.01" style="text-align: right;">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-6">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="startDate" class="shortInput" value="<?=$today?>" required>
                <label for="startTime">Time</label>
                <input type="time" id="startTime" name="startTime" class="shortInput" required>
            </div>
            <div class="col-sm-6">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="endDate" class="shortInput" value="<?=$today?>" required>
                <label for="endTime">Time</label>
                <input type="time" id="endTime" name="endTime" class="shortInput" required>
            </div>
        </div>
    </div>
    <?php submitButton("Submit", "submit", "btnsubmit") ?>
    <input value="direct" name="combination" style="display: none;" readonly>
</form>

<?php include_once('../forms/footer.php'); ?>
