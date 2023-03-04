<?php $pageTitle="Release Request"; ?>
<?php include("../forms/header.php");?>
<?php include ("../connection/databaseConn.php");
$relNo = nextDocNumber("release_request", "release_no", "RLS"); 
?>
    
<form class="regularForm" method="POST" style="height:fit-content; width:800px" action="../connection/release.php">
    <h3 id="deliveryNoteHeading" class="formHeading">Release Request</h3>
    <?php
        include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label for="relNo" style="grid-column: 1; grid-row: 1; width:80px; margin-top: 5px">Release No:</label>
        <input type="text" class="shortInput" id="relNo" name="relNo" required value="<?= $relNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="relDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="relDate" name="relDate" required value="<?= $today?>" style="grid-column: 2; grid-row: 2">
    </div><br><br>
    <?php include("../forms/customerSelector.php") ?>
    
    <?php itemsTable(10, "Delivery Items"); ?>
    

    <div class="container" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-6">
                <label for="destination">Destination</label><br>
                <input style="width: 200px;" type="text" id="destination" required class="shortInput" name="destination">
            </div>
            <div class="col-md-6">
                <label for="initiator">Initiated By:</label><br>
                <input style="width: 300px;" type="text" id="initiator" class="shortInput" required name="initiator" placeholder="Initiated by">
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <label for="remarks">Remarks</label><br>
                <input style="width: 550px; " type="text" id="remarks" class="shortInput" name="remarks">
            </div>
        </div>
    </div>
    <?php submitButton("Submit", "submit", "btnsubmit"); ?>
</form>
    
<?php include("../forms/footer.php");?>
<script src="../assets/js/itemSelector.js" ></script>