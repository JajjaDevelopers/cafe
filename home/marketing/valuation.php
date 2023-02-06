<?php $pageTitle="Valuation Report"; ?>
<?php include_once('../forms/header.php'); 
include ("../connection/databaseConn.php");
$valuationNumber = nextDocNumber("valuation_report_summary", "valuation_no", "VAL");
?>
<form id="valuationForm" name="valuationForm" class="regularForm" style="height:fit-content; width: 900px" method="POST" action="../connection/valuation.php">
    <h3 class="formHeading">VALUATION REPORT</h3>
    <?php
     include "../alerts/message.php";
    ?>
    <div class="container">
        <div class="row" style="margin-left: 65%;">
            <div class="col-md-6" style="display:grid; margin-top:15px">
                <label for="valuationNumber" style="text-align: right;">Valuation No.:</label>
                <label for="valuationDate" style="text-align: right; margin-top:5px">Date:</label>
                <label for="batchNo" style="text-align: right; margin-top:5px">Batch No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" id="valuationNumber" name="valuationNumber" class="shortInput" readonly value="<?=$valuationNumber?>"
                style="width: 100px; text-align: center;">
                <input type="date" id="valuationDate" name="valuationDate" value="<?=$today?>" class="shortInput" style="width: 100px; text-align: center;"><br>
                <input type="number" id="batchNo" name="batchNo" class="shortInput" value="" style="width: 100px; text-align: center;"
                onchange="updateOrder(this.value)">
            </div>
        </div>
    <div>
        <br>
        <?php include("../forms/customerSelector.php") ?>
        <br>
    <div id="ajaxDiv" style="display: none;"></div>
    
        <table id="valuationsTable">
            <tr>
                <th colspan="8" style="text-align: center;">VALUATION SCHEDULE</th>
            </tr>
            <tr>
                <td>Kibooko Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="" id="kibookoQty" name="kibookoQty" class="tableInput"></td>
                <td colspan="3">FAQ Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="12000" id="FAQQty" name="FAQQty" class="tableInput"></td>
            </tr>
            <tr>
                <td>Exchange Rate</td>
                <td colspan="2"><input type="number" value="<?= $fxRate?>" id="exchangeRate" name="exchangeRate" class="tableInput"></td>
                <td colspan="5">Market facilitator and owner settlement rate</td>
                
            </tr>
            <tr>
                <th style="width: 200px;">Grade/Screen</th>
                <th style="width: 60px;">Actual Yield (%)</th>
                <th style="width: 80px;">QTY (Kg)</th>
                <th style="width: 60px;">Price (US$)/Kg</th>
                <th style="width: 60px;">Price (Cts/lb)</th>
                <th style="width: 60px;">Price (Ugx/Kg)</th>
                <th style="width: 80px;">Amount (US$)</th>
                <th style="width: 100px;">Amount (UGX)</th>
            </tr>
            
            
            <?php 
                for ($row = 1; $row <= 10; $row ++){
                    valuationItemRow($row); 
                }
            
            ?>
            
            
            <tr>
                <th>Actual Total Value Before Costs</th>
                <td><input type="number" value="" id="totalYield" readonly name="totalYield" class="tableInput"></td>
                <td><input type="number" value="" id="totalQty" readonly name="totalYield" class="tableInput"></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="number" value="" id="grandTotaltUs" readonly name="grandTotaltUs" class="tableInput"></td>
                <td><input type="number" value="" id="grandTotaltUgx" readonly name="grandTotaltUgx" class="tableInput"></td>
            </tr>
            <tr>
                <th>Less Costs</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6"><input type="text" value="Costs:" id="costsDetails" name="costsDetails" class="tableInput" 
                style="text-align: left;" placeholder="Enter description of costs..."></td>
                
                <td><input type="number" value="" id="totalCostsUsd" readonly name="totalCostsUsd" class="tableInput"></td>
                <td><input type="number" value="" id="totalCostsUgx" name="totalCostsUgx" class="tableInput"></td>
            </tr>
            <tr>
                <th colspan="6">Sub-total Costs</th>
                
                <td><input type="number" value="" id="subTotalCostsUsd" readonly name="subTotalCostsUsd" class="tableInput"></td>
                <td><input type="number" value="" id="subTotalCostsUgx" readonly name="subTotalCostsUgx" class="tableInput"></td>
            </tr>
            <tr>
                <th colspan="6">Total Value after Costs</th>
                
                <td><input type="number" value="" id="totalValueUsd" readonly name="totalValueUsd" class="tableInput"></td>
                <td><input type="number" value="" id="totalValueUgx" readonly name="totalValueUgx" class="tableInput"></td>
            </tr>
            
        </table>
    </div>
    <?php submitButton("Submit", "submit", "confirm"); ?>
</form>
<?php include_once('../forms/footer.php');?>
<!-- summarizing valuation info -->
<script>
    function updateOrder(str){
        
        
        var selectedClient = document.getElementById('valuationClient').value;
        var batchNo = selectedClient.slice(0,5);
        var batchOrderNumber =  document.getElementById('batchNo')
        var x = Number(batchNo);
        batchOrderNumber.setAttribute('value', (batchNo));
        
        
        if (str == "") {
            document.getElementById("customerId").setAttribute('value', '');
            document.getElementById("valuationSupplier").setAttribute('value', '');
            return;
        } 
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("ajaxDiv").innerHTML = this.responseText;

            var ajaxCustomerId = document.getElementById("cid").value;
            document.getElementById("customerId").setAttribute('value', ajaxCustomerId);

            var ajaxCustomerName = document.getElementById("name").value;
            document.getElementById("valuationSupplier").setAttribute('value', ajaxCustomerName);

            var ajaxInputContactPerson = document.getElementById("contactPerson").value;
            document.getElementById("valuationContactPerson").setAttribute('value', ajaxInputContactPerson);

            var ajaxTel = document.getElementById("tel").value;
            document.getElementById("valuationTelephone").setAttribute('value', ajaxTel);
            

            var ajaxGrnNo= document.getElementById("grnNo").value;
            document.getElementById("valuationGrnNumber").setAttribute('value', ajaxGrnNo);

            // var ajaxInputGrade = document.getElementById("gradeName").value;
            // document.getElementById("FAQQty").setAttribute('value', ajaxInputGrade);

            var ajaxInputQty = document.getElementById("inputQty").value;
            document.getElementById("FAQQty").setAttribute('value', ajaxInputQty);

        }
        xhttp.open("GET", "../ajax/valuationAjax.php?q="+str);
        xhttp.send();
        
        // xhttp.onload = function() {
        //     document.getElementById("customerName").value = this.responseText;
        // }
        // xhttp.open("GET", "ajax/batchReportAjax.php?q="+str);
        // xhttp.send();
        
    }
    
</script>
<!-- <script src=".\ASSETS\SCRIPTS\valuationJavaScript.js"></script> -->
<script src="../assets/js/valuationJavaScript.js"></script>

