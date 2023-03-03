<?php include ("../connection/databaseConn.php"); ?>
<?php
$pageTitle="Goods Received Note";
$grnNo = nextDocNumber('grn', 'grn_no', 'GRN');
?>
<?php include_once('../forms/header.php'); ?>

  <!-- <div class="container"> -->
  <form action="../connection/grn.php" class="regularForm" method="POST" style="height:fit-content; width: 1000px">
    <?php //include "../templates/grnTemplate.php" ?>
    <legend class="formHeading">Goods Received Note</legend>
<div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
<?php
    
    include "../alerts/message.php";
?>
<div style="display: grid; width:fit-content; margin-left: 70%;">
    <input name="grnKeyId" readonly value="<?= $grn_no?>" style="display: none;" >
    <label for="grnNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">GRN No:</label>
    <input type="text" class="shortInput" id="grnNo" name="grnNo" readonly value="<?= $grnNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
    <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
    <input type="date" class="shortInput" id="grnDate" name="grnDate" value="<?= $grn_date ?>" style="grid-column: 2; grid-row: 2">
    <label for="timeIn" class="" style="grid-column: 1; grid-row: 3; margin-top: 10px">Time In:</label>
    <input type="time" class="shortInput" id="timeIn" name="timein"  value="<?= $grn_time_in ?>" style="grid-column: 2; grid-row: 3">
</div>

<?php 
require("../forms/customerSelector.php"); ?>
<br>
    
<div class="container" style="margin: 0px; padding:0px">
    <div class="row">
        <div class="col-sm-12">
            <label>Coffee Details</label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="type">Type:</label><br>
            <select id="type" name="coffeetype" class="shortInput"
                onchange="itemFilterOptions('category',this.value, 'typeCat')">
                <option value="all">All</option>
                <option value="Arabica">Arabica</option>
                <option value="Robusta">Robusta</option>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="category">Type Category:</label><br>
            <select id="category" name="category" class="shortInput" style="width: 150px;"
                onchange="itemFilterOptions('gradeId',this.value, 'grades')">
                <option value="all">All</option>
                
            </select>
        </div>
        <div class="col-sm-4">
            <label for="gradeId">Grade:</label><br>
            <select id="gradeId" name="coffeegrades" class="shortInput" style="width: 150px;">
                <option value="all">All</option>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="weight" >Weight:</label><br>
            <input type="number" id="weight"  class="shortInput" placeholder="kgs" 
            name="gradeweight"  value="<?=$grn_qty?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="bags" class="form-label">Bags:</label><br>
            <input type="number" class="shortInput" id="bags" placeholder="bags" name="bags"  
            value="<?=$no_of_bags?>" style="margin-top: 0px; ">
        </div>
        <div class="col-sm-3">
            
            <label for="mc" >Av. Moisture:</label><br>
            <input type="number" class="shortInput" id="mc" placeholder="%" name="mc"  value="<?=$grn_mc?>" 
            style="margin-top: 10px; width: 70px" step="0.01">
        </div>
        <div class="col-sm-4">
            
            <label for="purpose">Purpose:</label><br>
            <select class="longInputField" id="purpose" placeholder="purpose" name="purpose" 
            style="margin-top: 10px; width:150px; margin-left:0px" onchange="getPreOffSampleNo()">
                <option></option>
                <option value="Processing">Processing</option>
                <option value="Roasting">Roastery Services</option>
                <option value="Storage">Storage</option>
                <option value="Sale">Sale to Nucafe</option>
            </select>
        </div>
        <div class="col-sm-3">
            
            <label for="weight" >Pre-Off Sample:</label><br>
            <select id="preOffSample" name="preOffSample" class="shortInput" ></select>
        </div>
    </div>
    
</div><br>
<div class="container" style="margin: 0px;">
    <div class="row">
        <div class="col-sm-12">
            <label>Delivery Details</label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="region">Region:</label><br>
            <select type="text" class="shortInput" id="region" name="region" 
            onchange="locationFilters('origin', this.value, 'district')">
                <?php getRegion(); ?>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="origin">District:</label><br>
            <select type="text" class="shortInput" id="origin" name="origin" style="width: 150px;">

            </select>
        </div>
        <div class="col-sm-4">
            <label for="driverName">Driver:</label><br>
            <input type="text" class="longInputField" id="driverName" placeholder="driver name"  
            name="driverName" value="<?=$driver?>" style="width:200px">
        </div>
        <div class="col-sm-3">
            <label for="truckNumber">Truck Number:</label><br>
            <input type="text" class="shortInput" id="truckNumber" placeholder="number" name="truckNumber" 
            value="<?=$truck_no?>" style="width: 110px;">
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-5">
            <label for="deliveryPerson">Delivery Person:</label>
            <input type="text" class="longInputField" id="deliveryPerson" placeholder="delivery person" 
            name="deliveryPerson" value="<?=$delivery_person?>"><br>
        </div>
    </div>
</div>

<div style="display: grid; margin-top:30px">
<div class="">
    
    
    
    
</div>
</div>


<div style="margin-top: 20px;">
    <label for="customer" class="form-label">Quality Remarks:</label>
    <input class="form-control" id="remarks" name="remarks" value="<?=$quality_remarks?>" placeholder="quality remarks" rows="3">
</div>
<?php //include "../forms/users.php" ?>

    <?php submitButton("Submit", "Submit", "btnsubmit");?>
      
  </form>

  <?php include_once('../forms/footer.php'); ?>
  <script>
     document.getElementById("print").style.display="none";
  </script>
  <script src="../assets/js/locationsFilter.js"></script>
  <script>
    document.getElementById("grnDate").setAttribute("value", "<?= $today?>");
    function getGrades(str){
      if (str == " ") {
          return;
      } 
      const xhttp = new XMLHttpRequest();
      // Updating grades based on coffee type
      xhttp.onload = function() {
          document.getElementById("gradeId").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/grnAjax.php?q="+str);
      xhttp.send();
    }   

    //get pre-offloading sample
    function getPreOffSampleNo(){
      document.getElementById("preOffSample").innerHTML = "";
      var custId = document.getElementById("customerId").value;
      var purpSelect = document.getElementById("purpose").value;
      if (custId == " ") {
          return;
      } 
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
          document.getElementById("preOffSample").innerHTML = this.responseText;
      }
      if (purpSelect == 'Processing' || purpSelect == 'Sale'){
        xhttp.open("GET", "../ajax/preOffloadSamp.php?q="+custId);
        xhttp.send();
      }
      
    }
  </script>