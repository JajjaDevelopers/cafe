
    <h3 class="formHeading">Coffee Bulking</h3>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="bulkingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Bulking No:</label>
        <input type="text" class="shortInput" id="bulkingNo" name="bulkingNo" value="<?= $bulkingNo?>" readonly style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="bulkingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="bulkingDate" name="bulkingDate" value="<?= $bulkDate?>" style="grid-column: 2; grid-row: 2">
    </div>
    <?php include("../forms/customerSelector.php") ?>
    <?php itemsTable(5, "Bulking Input"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <label>Bulking Output</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Grade</label>
                <input id="bulkOutGrdName" name="bulkOutGrdName" value="<?= $bulkOutGrd?>" class="shortInput" readonly style="width: 250px;">
                <select id="bulkOutGrd" name="bulkOutGrd" class="shortInput" style="width: 250px;"
                onchange="updateOutputQty()">
                    <?php selectCoffeeGrades(); ?>
                </select>
                
            </div>
        </div>
    </div>
    <?php documentNotes("700px") ?>