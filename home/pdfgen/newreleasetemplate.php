
     
<h3 id="deliveryNoteHeading" class="formHeading">Release Request</h3>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label id="dispNoLabel" for="dispNo" style="grid-column: 1; grid-row: 1; width:80px; margin-top: 5px">Dispatch No:</label>
        <input class="shortInput" id="dispNo" name="dispNo" value="<?= $dispNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;" readonly>
        <label for="relNo" style="grid-column: 1; grid-row: 2; width:80px; margin-top: 10px">Release No:</label>
        <input class="shortInput" id="relNo" name="relNo" value="<?= $relsNo?>" style="grid-column: 2; grid-row: 2; margin-top: 10px;" readonly>
        <label for="relDate" class="" style="grid-column: 1; grid-row: 3; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="relDate" name="relDate" value="<?= $relsDate?>" style="grid-column: 2; grid-row: 3">
    </div><br><br>
    <?php include("../forms/customerSelector.php") ?>
    
    <?php itemsTable(10, "Delivery Items"); ?>
    
    <div class="container" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-6">
                <label for="destination">Destination</label><br>
                <input style="width: 200px;" type="text" id="destination" class="shortInput" name="destination" value="<?=$destn?>">
            </div>
            <div class="col-md-6">
                <label for="initiator">Initiated By:</label><br>
                <input style="width: 300px;" type="text" id="initiator" class="shortInput" name="initiator" value="<?=$initiator?>" placeholder="Initiated by">
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12">
                <label for="remarks">Remarks</label><br>
                <input style="width: 550px; " type="text" id="remarks" class="shortInput" name="remarks" value="<?=$comt?>">
            </div>
        </div>
    </div>
    <div id="usersDiv" class="container">
    <div class="row">
        <div class="col-md-4">
            <?= "Prepared By: ".$prepBy?><br>
            <?= "Verified By: ".$verBy?><br>
            <?= "Approved By: ".$apprBy?>
        </div>
        <div class="col-md-8">
            <?= "Date: ".$prep_time ?><br>
            <?= "Date: ".$ver_time ?><br>
            <?= "Date: ".$appr_time ?>
        </div>
    </div>
    </div>
<script src="../assets/js/itemSelector.js" ></script>
