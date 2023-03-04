<?php $pageTitle="Coffee Drying"; ?>
<?php
include("../private/database.php");
include("../forms/header.php");
$dryingNo = nextDocNumber("drying", "drying_no", "DRY");
?>

<form action="../connection/drying.php" method="POST" class="regularForm" style="width: 750px; height:fit-content">
  <h3 class="formHeading">DRYING FORM</h3>
  <?php
    include "../alerts/message.php";
  ?>
  
  <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="dryingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Drying No:</label>
    <input type="text" class="shortInput" id="dryingNo" name="dryingNo" readonly required value="<?= $dryingNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="dryingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="dryingDate" name="dryingDate" required value="<?= $today ?>" style="grid-column: 2; grid-row: 2">
  </div>
  <?php require("../forms/customerSelector.php");?>
  <fieldset class="form-group border p-3" style="border: 1px green solid; border-radius:5px; padding: 5px; margin-bottom:20px">
    <div class="row">
      <div class="col-xs-12">
        <label>Grade Item</label><br>
        <select id="itemCode" name="itemCode" class="shortInput" style="width: 300px;">
          <?php selectCoffeeGrades(); ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <label for="inputQty">Input Qty</label><br>
        <input type="number" id="inputQty" name="inputQty" required class="shortInput" style="width: 200px;" min="1" step="0.01">
      </div>
      <div class="col-sm-6">
        <label for="inputMc">Input Moisture (%)</label><br>
        <input type="number" id="inputMc" name="inputMc" required class="shortInput" step="0.01">
      </div>
    </div>
  </fieldset>
  <fieldset class="form-group border p-3" style="border: 1px green solid; border-radius:5px; padding: 5px">
    <div class="row" style="margin-top: 20px;">
        
      <div class="col-sm-6">
        <label for="outputQty">Output Qty</label><br>
        <input type="number" id="outputQty" name="outputQty" required class="shortInput" step="0.01" style="width: 200px;">
      </div>
      <div class="col-sm-6">
        <label for="inputMc">Output Moisture (%)</label><br>
        <input type="number" id="outputMc" name="outputMc" required class="shortInput" step="0.01">
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-sm-6">
        <label for="kgLoss">Moisture Loss (Kg)</label><br>
        <input type="number" id="dryLoss" name="dryLoss" required readonly class="shortInput" step="0.01" style="width: 200px;">
      </div>
    
      <div class="col-sm-6">
        <label for="percLoss">Moisture Loss(%)</label><br>
        <input type="number" id="percLoss" name="percLoss" readonly class="shortInput" step="0.01">
      </div>
    </div>
  </fieldset>
  

  <?php documentNotes("700px") ?>
<?php submitButton("Submit", "submit", "btnsubmit") ?>


</form>
<?php include("../forms/footer.php") ?>
<script>
  document.getElementById("inputQty").addEventListener("blur", getDryingLoss);
  document.getElementById("outputQty").addEventListener("blur", getDryingLoss);
  function getDryingLoss(){
    var inputQtyVar = Number(document.getElementById("inputQty").value);
    var outputQtyVar = Number(document.getElementById("outputQty").value);
    document.getElementById("dryLoss").setAttribute("value", inputQtyVar-outputQtyVar);
    document.getElementById("percLoss").setAttribute("value", (inputQtyVar-outputQtyVar)*100/inputQtyVar);
  }
</script>