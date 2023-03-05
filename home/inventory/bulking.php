<?php $pageTitle = "Coffee Bulking" ?>
<?php include "../forms/header.php"; ?>
<?php 
include ("../connection/databaseConn.php");
$bulkingNo = nextDocNumber("bulking", "bulk_no", "BLK"); 
?>
<form class="regularForm" method="post", action="../connection/bulking.php" style="height: fit-content;">
    <h3 class="formHeading">Coffee Bulking</h3>
    <?php include "../alerts/message.php" ?>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="bulkingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Bulking No:</label>
        <input type="text" class="shortInput" id="bulkingNo" name="bulkingNo" value="<?= $bulkingNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;" readonly>
        <label for="bulkingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="bulkingDate" name="bulkingDate" value="<?= $today?>" style="grid-column: 2; grid-row: 2" required>
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
                <select id="bulkOutGrd" name="bulkOutGrd" class="shortInput" style="width: 250px;"
                onchange="updateOutputQty()" required>
                    <?php selectCoffeeGrades(); ?>
                </select>
                
            </div>
        </div>
    </div>
    <?php comment("700px") ?>
    
    <?php submitButton("Submit", "submit", "btnsubmit"); ?>
</form>

<?php include "../forms/footer.php" ?>
<script src="../assets/js/itemSelector.js" ></script>
<script>
    
    //Updating output qty
    function updateOutputQty(){
        var totalBulkQty = document.getElementById("totalQty").value;
        var gradeOut = document.getElementById("bulkOutGrd").value;
        if (gradeOut == ""){
            document.getElementById("bulkOutQty").setAttribute("value", "");
        }else{
            document.getElementById("bulkOutQty").setAttribute("value", totalBulkQty);
        }
    }
    // document.getElementById("item1Qty").addEventListener("blur", updateOutputQty());
</script>