<?php $pageTitle="Add New Item"; ?>
<?php require "../forms/header.php" ?>
<?php include ("../connection/databaseConn.php");?>
<?php
// Item Label
function newLabel($gridColumnNo, $gridRowNo, $labelText){
    ?>
    <label style="grid-column:<?= $gridColumnNo ?>; grid-row:<?= $gridRowNo ?>" ><?= $labelText ?></label>
    <?php
}

// Item Input
function newInput($inputType, $inputId, $gridColumnNo, $gridRowNo, $placeHolder, $width){
    ?>
    <input type="<?= $inputType ?>" id="<?= $inputId ?>" name="<?= $inputId ?>" class="shortInput" 
    style="grid-column:<?= $gridColumnNo ?>; grid-row:<?= $gridRowNo ?>; width:<?= $width ?>" 
    placeholder="<?= $placeHolder ?>">
    <?php
}
?>
<form id="hullingForm" name="hullingForm" class="regularForm" style="height:auto;" method="POST" action="../connection/newItem.php">
    <h3 class="formHeading">New Item</h3>
    <div style="width: 50%; margin: auto;">
        <!-- <label class="radio-inline"><input type="radio" name="invType" value="ITEM">ITEM</label>
        <label class="radio-inline" style="margin-left: 50px;"><input type="radio" name="invType" value="SERVICE">SERVICE</label> -->
    </div>

    <div class="container">
        <div class="row" style="margin: 10px 0px;">
            <div class="col-md-3">
                <label>Item ID</label><br>
                <input type="text" id="itemId" name="itemId" class="shortInput" placeholder="ID" maxlength="6" minlength="6">
            </div>
            <div class="col-md-5">
                <label>Item Name</label><br>
                <input type="text" id="ItemName" name="ItemName" class="shortInput" style="width:200px" placeholder="ID">

            </div>
            <div class="col-md-4">
                <label style="margin-bottom: 10px">Inventory Type</label><br>
                <input type="radio" name="invType" value="ITEM"><label style="margin-left: 10px;">ITEM</label>
                <input type="radio" name="invType" value="SERVICE" style="margin-left: 30px;"><label style="margin-left: 10px;">SERVICE</label>
            </div>
        </div>
        <div class="row" style="margin: 10px 0px;">
            <div class="col-md-3">
                <label for="coffeeType">Coffee Type</label><br>
                <select id="coffeeType" name="coffeeType" class="shortInput">
                    <option></option>
                    <option value="Robusta">Robusta</option>
                    <option value="Arabica">Arabica</option>
                    <option value="Roasted">Roasted</option>
                    <option value="NONE">NONE</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="typeCategory">Coffee Type</label><br>
                <select id="typeCategory" name="typeCategory" class="shortInput" style="width: 200px;">
                    <option></option>
                    <option value="Natural">Natural Robusta</option>
                    <option value="Washed Robusta">Washed Robusta</option>
                    <option value="Wugar">Wugar</option>
                    <option value="Drugar">Drugar</option>
                    <option value="Roasted Beans">Roasted Beans</option>
                    <option value="Roast and Ground">Roast and Ground</option>
                    <option value="NONE">NONE</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="gradeCategory">Grade Category</label><br>
                <select id="gradeCategory" name="gradeCategory" class="shortInput" style="width: 200px">
                    <option></option>
                    <option value="HIGH">HIGH</option>
                    <option value="LOW">LOW</option>
                    <option value="BLACKS">BLACKS</option>
                    <option value="UNPROCESSED">UNPROCESSED</option>
                    <option value="OTHER LOSSES">OTHER LOSS</option>
                    <option value="WASTES">WASTES</option>
                    <option value="ROASTED">ROASTED</option>
                    <option value="NONE">NONE</option>
                </select>
            </div>
        </div>
        <div class="row" style="margin: 10px 0px;">
            <div class="col-md-3">
                <label for="unitSymbol">Unit Symbol</label><br>
                <input type="text" id="unitSymbol" name="unitSymbol" class="shortInput" placeholder="Unit">
            </div>
            <div class="col-md-5">
                <label for="unitSymbol">Grade Rank</label><br>
                <input type="text" id="gradeRank" name="gradeRank" class="shortInput" style="width:200px" placeholder="Rank">

            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>

    <?php include "../forms/submitButton.php" ?>
</form>
<script>
    document.onload = function(){document.getElementById("itemId").style.maxLength = "4";}
    
</script>
<?php include "../forms/footer.php" ?>
