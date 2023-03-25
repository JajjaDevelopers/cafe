<?php $pageTitle="Sales Report"; ?>
<?php include_once('../forms/header.php');?>
<?php include ("../connection/databaseConn.php");
$nextSalesNo = nextDocNumber("sales_reports_summary", "sales_report_no", "SR");
?>

<form class="regularForm" style="height: fit-content; width:900px" method="POST" action="../connection/salesreport.php">
    <h2 class="formHeading">SALES REPORT</h2>
        <?php
            include "../alerts/message.php";
        ?>
    <div style="margin-left: 70%;">
        <label for="salesReportNumber" id="salesReportNumberLabel" class="salesReportLabel" >Sales No.:</label>
        <input type="text" id="salesReportNumber" readonly class="shortInput" style="width: 100px; text-align: center;"
        value="<?php echo $nextSalesNo; ?>" required><br>

        <label for="salesReportDate" id="salesReportNumberLabel" class="salesReportLabel" >Date:</label>
        <input type="date" id="salesReportDate" name="salesReportDate" class="shortInput" value="<?=$today?>" style="width: 100px; text-align: center;" required><br>

        <label for="exchangeRate" class="salesReportLabel" >Exchange Rate:</label>
        <input type="number" id="exchangeRate" name="exchangeRate" class="longInputField" placeholder="Ex.Rate" step="0.0001" style="width: 90px; margin-right: 0px;" required>
      
    </div>
    <div id="ajaxDiv" style="display: none;"> </div>
    <div>
        <label for="salesReportBuyer" id="salesReportBuyerLabel" class="salesReportLabel" >Buyer:</label>
        <input type="text" id="BuyerId" name="BuyerId" readonly class="longInputField" placeholder="ID" style="width: 70px; margin-right: 0px;">
        <input type="text" id="BuyerName" name="BuyerName" readonly class="longInputField" placeholder="Buyer Name" style="margin-left: 0px; margin-right: 0px;" required>
        <select id="salesReportBuyer" class="longInputField" name="salesReportBuyer" style="margin-left: 0px; width: 20px"
        onchange="SelectCustomer(this.value)" required>
            <?php GetCustomerList(); ?>
        </select><br>

        <label for="salesReportContact" id="salesReportBuyerLabel"  class="salesReportLabel" >Contact:</label>
        <input type="text" id="salesReportContact" readonly class="longInputField" placeholder="Contact Person" style="margin-right: 0px; width:150px">
        <label for="salesReportContact" id="salesReportBuyerLabel" class="salesReportLabel" >Tel:</label>
        <input type="text" id="salesReportTel" readonly class="longInputField" placeholder="Telephone" style="margin-right: 0px; width:120px">
        <br>
        <label for="salesReportCategory" id="salesReportBuyerLabel" class="salesReportLabel">Category:</label>
        <select id="salesReportCategory" class="longInputField" name="salesReportCategory" style="width: 100px;" required>
            <option value="Local">Local Sale</option>
            <option value="Export">Export</option>
        </select>

        <label for="salesReportCurrency" class="salesReportLabel">Currency:</label>
        <select id="salesReportCurrency" class="longInputField" name="salesReportCurrency" style="width: 100px;">
            <option value="UGX">UGX</option>
            <option value="USD">USD</option>
            <!-- <option value="EUR">EUR</option> -->
        </select>
    </div>
    <div>
        <table>
            <tr>
                <th style="width: 355px;">Grade</th>
                <th style="width: 80px;">QTY (Kgs)</th>
                <th style="width: 100px;">Batch Number</th>
                <th style="width: 70px;">Price (USD/Kg)</th>
                <th style="width: 70px;">Price (UGX/Kg)</th>
                <th style="width: 100px;">Amount (USD)</th>
                <th style="width: 100px;">Amount (UGX)</th>
            </tr>
            <?php
            for ($i=1;$i<=10;$i++){
                ?>
            <tr>
                <td>
                    <div id="item1Field" style="display: grid;" class="itemName">
                        <input type="text" value="" id="<?= 'item'.$i.'Code'?>" readonly name="<?= 'item'.$i.'Code'?>" class="itmNameInput" style="grid-column: 1; width: 60px; display:none">
                        <input type="text" value="" id="<?= 'item'.$i.'Name'?>" readonly name="<?= 'item'.$i.'Name'?>" class="itmNameInput" style="grid-column: 2; width: 330px">
                        <select id="<?= 'item'.$i.'Select'?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="setCodeAndName(this.id)">
                            <?php CoffeeGrades(); ?>
                        </select>
                    </div>
                </td>
                <td><input type="number" value="" id="<?= 'item'.$i.'Qty'?>" name="<?= 'item'.$i.'Qty'?>" step="0.001" class="tableInput"></td>
                <td><input type="text" value="" id="<?= 'item'.$i.'Batch'?>" name="<?= 'item'.$i.'Batch'?>" class="tableInput"></td>
                <td><input type="number" value="" id="<?= 'item'.$i.'UsdPx'?>" name="<?= 'item'.$i.'UsdPx'?>" step="0.0001" class="tableInput"></td>
                <td><input type="number" value="" id="<?= 'item'.$i.'UgxPx'?>" name="<?= 'item'.$i.'UgxPx'?>" step="0.0001" class="tableInput"></td>
                <td><input type="number" value="" id="<?= 'item'.$i.'UsdAmount'?>" readonly name="<?= 'item'.$i.'UsdAmount'?>" class="tableInput"></td>
                <td><input type="number" value="" id="<?= 'item'.$i.'UgxAmount'?>" readonly name="<?= 'item'.$i.'UgxAmount'?>" class="tableInput"></td>
            </tr>
            <?php
            }
            ?>
           
            <tr>
                <th>Total</th>
                <th><input type="number" value="" id="totalQty" readonly name="totalQty" class="tableInput"></th>
                <th></th>
                <th></th>
                <th></th>
                <th><input type="number" value="" id="usdGrandTotal" readonly name="usdGrandTotal" class="tableInput"></th>
                <th><input type="number" value="" id="ugxGrandTotal" readonly name="ugxGrandTotal" class="tableInput"></th>
            </tr>
        </table>
        <div style="max-height: 50px;">
            <label for="salesReportNotes">Notes:</label><br>
            <textarea id="salesReportNotes" name="salesReportNotes" class="remarks" rows="3" maxlength="100"
            style="resize: vertical; max-height: 50px; min-height: 30px; padding: 5px 10px;"></textarea>
        </div>
        
    </div>

    <?php submitButton("Submit", "submit", "btnsubmit") ?>
    
</form>
<?php   include_once('../forms/footer.php'); ?>
<script>
       
</script>
<script src="../assets/js/salesreport.js"></script>
<!-- <script src="../assets/js/salesreport.js"></script> -->

