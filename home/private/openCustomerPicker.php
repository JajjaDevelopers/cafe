<?php include "database.php"; ?>
<div id="ajaxDiv" style="display: none;"> </div>
  <div id="customerDetailsDiv">
  <label for="salesReportBuyer" id="salesReportBuyerLabel" class="salesReportLabel" >Client:</label>
        <input type="text" id="customerId" name="customerId" readonly class="longInputField" placeholder="ID" style="width: 70px; margin-right: 0px;" >
        <input type="text" id="customerName" name="customerName" readonly class="longInputField" placeholder="Buyer Name" style="margin-left: 0px; margin-right: 0px;">
        <select id="salesReportBuyer" class="longInputField" name="salesReportBuyer" style="margin-left: 0px; width: 20px"
        onchange="SelectCustomer(this.value)">
        <!-- customer list function -->
        <!-- Closing customer picker file included here -->