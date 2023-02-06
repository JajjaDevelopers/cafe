<?php $pageTitle="Goods Received Note"; ?>
<?php include_once('header.php'); ?>
<?php include ("../connection/databaseConn.php"); ?>
  <!-- <div class="container"> -->
    <form action="../connection/grn.php" class="regularForm" method="POST" style="height: 800px;">
      <legend class="formHeading">Goods Received Note</legend>
      <?php
            include "../alerts/message.php";
      ?>
      <div style="display: grid; width:fit-content; margin-left: 70%;">
          <label for="grnNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">GRN No:</label>
          <input type="text" class="shortInput" id="grnNo" name="grnNo" value="<?php echo nextDocNumber('grn', 'grn_no', 'GRN-') ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
          <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
          <input type="date" class="shortInput" id="grnDate" placeholder="MM/DD/YYYY" name="grnDate" value="" style="grid-column: 2; grid-row: 2">
          <label for="timeIn" class="" style="grid-column: 1; grid-row: 3; margin-top: 10px">Time In:</label>
          <input type="time" class="shortInput" id="timeIn" name="timein" value="" style="grid-column: 2; grid-row: 3">
      </div>
     
      <?php 
      require("customerSelector.php"); ?>
      <br>
      <div style="display: grid; width:fit-content ">
        <div style="grid-column: 1; grid-row:1;">
          <label >Coffee Details</label>
          <div>
            <label for="type">Type</label>
            <select class="shortInput" name="coffeetype" id="type" onchange="getGrades(this.value)">
              <option></option>
              <option value="Robusta">Robusta</option>
              <option value="Arabica">Arabica</option>
            </select>
            <br>
            <label>Grade:</label>
            <select id="gradeId" name="coffeegrades" class="shortInput" style="width: 250px;">

            </select>
            <br>
            <label for="weight" class="form-label">Weight:</label>
            <input type="number" id="weight"  class="shortInput" id="grdweight" placeholder="kgs" name="gradeweight" value="">
            <label for="bags" class="form-label" style="margin-left: 50px;">Bags:</label>
            <input type="number" class="shortInput" id="bags" placeholder="bags" name="bags" value="" style="margin-top: 0px; width: 60px">
          </div>
        </div>
        <div style="grid-column: 2; grid-row:1; margin: 20px 0px 0px 150px">
          <label for="mc" class="form-label" style="margin: 0px 0px 0px 0px;">Average Moisture:</label>
          <input type="number" class="shortInput" id="mc" placeholder="%" name="mc" value="" style="margin-top: 0px; width: 70px"><br>
          <label for="purpose" class="">Purpose:</label><br>
          <select class="longInputField" id="purpose" placeholder="purpose" name="purpose" style="margin-left: 0px; width:280px">
            <option value="Processing">Processing</option>
            <option value="Roasting">Roastery Services</option>
            <option value="Storage">Storage</option>
          </select>
        </div>
      </div>
      <div style="display: grid; margin-top:30px">
        <div class="">
          <label for="origin" class="form-label">Origin:</label>
          <input type="text" class="longInputField" id="origin" placeholder="district" name="origin" value="" style="width: 150px;">
          <label for="deliveryPerson" class="" style="margin-left: 210px;">Delivery Person:</label>
          <input type="text" class="longInputField" id="deliveryPerson" placeholder="delivery person" name="deliveryPerson" value=""><br>
          <label for="trucknumber" class="">Truck Number:</label>
          <input type="text" class="shortInput" id="truckNumber" placeholder="number" name="truckNumber" value="" style="width: 110px;">
          <label for="driver" class="" style="margin-left: 210px;">Driver:</label>
          <input type="text" class="longInputField" id="driverName" placeholder="driver name" name="driverName" value="" style="margin-left: 10px; width:200px">
        </div>
      </div>


      <div style="margin-top: 20px;">
          <label for="customer" class="form-label">Quality Remarks:</label>
          <textarea class="form-control" id="remarks" name="remarks" placeholder="quality remarks" rows="3"></textarea>
      </div>
      
    <?php include_once("../private/approvalDetails.php"); ?>
  </form>

  <?php include_once('footer.php'); ?>
  <script>
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
  </script>