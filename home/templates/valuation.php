<div style="width: 928px;">
    <h3 class="formHeading">VALUATION REPORT</h3>
    <?php
        include "../alerts/message.php";
    ?>
    <div class=" mt-3 ms-5 d-flex flex-column align-items-start">
        <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
        </i>
    </div>
    <div class="container" style="margin: 0px; padding:0px">
        <div class="row" style="margin: 5px;">
            <div class="col-md-10" style="margin-top:15px">
                <label for="valuationNumber" style="text-align: right; display:block">Valuation No.:</label>
                <label for="valuationDate" style="text-align: right; margin-top:10px;  display:block">Date:</label>
                <label for="batchNo" style="text-align: right; margin-top:10px;  display:block">Batch No:</label>
            </div>
            <div class="col-md-2" style="margin: 0px;">
                <input name="valNum" value="<?=$valNo?>" readonly style="display: none;">
                <input type="text" id="valuationNumber" name="valuationNumber" class="shortInput" readonly value="<?=$valuationNumber?>"
                style="width: 100px; text-align: center; display:block">
                <input type="date" id="valuationDate" name="valuationDate" value="<?=$valDate?>" class="shortInput" style="width: 100px; text-align: center;  display:block">
                <input type="number" id="batchNo" name="batchNo" class="shortInput" value="<?=$batcNo?>" style="width: 100px; text-align: center;  display:block"
                >
            </div>
        </div>
    </div>
    <div>
        <?php include("../forms/customerSelector.php") ?>
    </div>
    <div id="ajaxDiv" style="display: none;">
    </div>

    <table id="valuationsTable">
        <tr>
            <th colspan="8" style="text-align: center;">VALUATION SCHEDULE</th>
        </tr>
        <tr>
            <td>Kibooko Delivered (Kg)</td>
            <td colspan="2"><input type="number" value="" id="kibookoQty" name="kibookoQty" class="tblNum" readonly></td>
            <td colspan="3">FAQ Delivered (Kg)</td>
            <td colspan="2"><input type="number" value="<?=$inputQty?>" id="FAQQty" name="FAQQty" class="tblNum" readonly></td>
        </tr>
        <tr>
            <td>Exchange Rate</td>
            <td colspan="2"><input type="number" value="<?= $fxRate?>" id="exchangeRate" name="exchangeRate" class="tblNum" readonly></td>
            <td colspan="5">Market facilitator and owner settlement rate</td>
            
        </tr>
        <tr>
            <th style="width: 300px;">Grade/Screen</th>
            <th style="width: 60px;">Actual Yield (%)</th>
            <th style="width: 80px;">QTY (Kg)</th>
            <th style="width: 60px;">Price (US$)/Kg</th>
            <th style="width: 60px;">Price (Cts/lb)</th>
            <th style="width: 100px;">Price (Ugx/Kg)</th>
            <th style="width: 100px;">Amount (US$)</th>
            <th style="width: 120px;">Amount (UGX)</th>
        </tr>
        
        
        <?php 
            for ($row = 1; $row <= 10; $row ++){
                valuationItemRow($row); 
            }
        
        ?>
        
        
        <tr>
            <th>Actual Total Value Before Costs</th>
            <td><input type="number" value="" id="totalYield" readonly name="totalYield" class="tblNum"></td>
            <td><input type="number" value="" id="totalQty" readonly name="totalYield" class="tblNum"></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="number" value="" id="grandTotaltUs" readonly name="grandTotaltUs" class="tblNum" style="text-align: right;"></td>
            <td><input type="number" value="" id="grandTotaltUgx" readonly name="grandTotaltUgx" class="tblNum" style="text-align: right;"></td>
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
            
            <td><input type="number" value="" id="totalCostsUsd" readonly name="totalCostsUsd" class="tblNum" style="text-align: right;"></td>
            <td><input type="number" value="" id="totalCostsUgx" name="totalCostsUgx" class="tblNum" style="text-align: right;"></td>
        </tr>
        <tr>
            <th colspan="6">Sub-total Costs</th>
            
            <td><input type="number" value="" id="subTotalCostsUsd" readonly name="subTotalCostsUsd" class="tblNum" style="text-align: right;"></td>
            <td><input type="number" value="<?= $valCosts ?>" id="subTotalCostsUgx" readonly name="subTotalCostsUgx" class="tblNum" style="text-align: right;"></td>
        </tr>
        <tr>
            <th colspan="6">Total Value after Costs</th>
            
            <td><input type="number" value="" id="totalValueUsd" readonly name="totalValueUsd" class="tblNum" style="text-align: right;"></td>
            <td><input type="number" value="" id="totalValueUgx" readonly name="totalValueUgx" class="tblNum" style="text-align: right;"></td>
        </tr>
    </table>

    <?php include "../forms/users.php" ?>
</div>


