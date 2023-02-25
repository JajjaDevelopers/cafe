  <h3 class="formHeading">DRYING REPORT</h3>
  <?php
    include "../alerts/message.php";
  ?>
  <div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
  <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
    <label for="dryingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Drying No:</label>
    <input type="text" class="shortInput" id="dryingNo" name="dryingNo" value="<?= $dryingNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="dryingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="dryingDate" name="dryingDate" value="<?= $dryDate ?>" style="grid-column: 2; grid-row: 2">
  </div>
  <?php require("../forms/customerSelector.php");?>
  <fieldset class="form-group border p-3" style="border: 1px green solid; border-radius:5px; padding: 5px; margin-bottom:20px">
    <div class="row">
      <div class="col-xs-12">
        <label>Grade Item</label><br>
        <input id="itmName" value="<?= $gradeName ?>"  class="shortInput" style="width: 300px;">
        <select id="itemCode" name="itemCode" class="shortInput" style="width: 300px;">
          <?php selectCoffeeGrades(); ?>
        </select>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-sm-6">
        <label for="inputQty">Input Qty</label><br>
        <input type="text" id="inputQty" name="inputQty" value="<?= num($inQty) ?>" class="shortNum" style="width: 200px;" step="0.01">
      </div>
      <div class="col-sm-6">
        <label for="inputMc">Input Moisture (%)</label><br>
        <input type="text" id="inputMc" name="inputMc" value="<?= num($inMc) ?>" class="shortNum" step="0.01">
      </div>
    </div>
  </fieldset>
  <fieldset class="form-group border p-3" style="border: 1px green solid; border-radius:5px; padding: 5px">
    <div class="row" style="margin-top: 20px;">  
      <div class="col-sm-6">
        <label for="outputQty">Output Qty</label><br>
        <input type="text" id="outputQty" name="outputQty" value="<?=num($outQty)  ?>" class="shortNum" style="width: 200px;">
      </div>
      <div class="col-sm-6">
        <label for="inputMc">Output Moisture (%)</label><br>
        <input type="text" id="outputMc" name="outputMc" value="<?= num($outMc) ?>" class="shortNum" step="0.01">
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-sm-6">
        <label for="kgLoss">Weight Loss (Kg)</label><br>
        <input type="text" id="dryLoss" name="dryLoss" value="<?= num($dryLoss) ?>" class="shortNum" step="0.01" style="width: 200px;">
      </div>
    
      <div class="col-sm-6">
        <label for="percLoss">Weight Loss(%)</label><br>
        <input type="text" id="percLoss" name="percLoss" value="<?= num($dryLoss*100/$inQty) ?>" class="shortNum" step="0.01">
      </div>
    </div>
  </fieldset>
  <?php
  documentNotes("700px");
  include "../forms/users.php";
  ?>
<script>
  // document.getElementById("inputQty").addEventListener("blur", getDryingLoss);
  // document.getElementById("outputQty").addEventListener("blur", getDryingLoss);
  // function getDryingLoss(){
  //   var inputQtyVar = Number(document.getElementById("inputQty").value);
  //   var outputQtyVar = Number(document.getElementById("outputQty").value);
  //   document.getElementById("dryLoss").setAttribute("value", inputQtyVar-outputQtyVar);
  //   document.getElementById("percLoss").setAttribute("value", (inputQtyVar-outputQtyVar)*100/inputQtyVar);
  // }
</script>