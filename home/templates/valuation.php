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
            <input type="date" id="valuationDate" name="valuationDate" value="<?=$valDate?>" class="shortInput" style="width: 100px; text-align: center;"><br>
            <input type="number" id="batchNo" name="batchNo" class="shortInput" value="<?=$batcNo?>" style="width: 100px; text-align: center;"
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
            <td><input type="number" value="<?= $valCosts ?>" id="subTotalCostsUgx" readonly name="subTotalCostsUgx" class="tableInput"></td>
        </tr>
        <tr>
            <th colspan="6">Total Value after Costs</th>
            
            <td><input type="number" value="" id="totalValueUsd" readonly name="totalValueUsd" class="tableInput"></td>
            <td><input type="number" value="" id="totalValueUgx" readonly name="totalValueUgx" class="tableInput"></td>
        </tr>
    </table>
</div>
<?php include "../forms/users.php" ?>
<script>
    document.getElementById("customerId").value = "<?=$clientId?>";
    document.getElementById("customerName").value = "<?=$clientName?>";
    document.getElementById("salesReportContact").value = "<?=$contact?>";
    document.getElementById("salesReportTel").value = "<?=$tel?>";
</script>
