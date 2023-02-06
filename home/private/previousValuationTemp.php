<?php
$summarySql = $conn->prepare("SELECT * FROM valuation_report_summary WHERE valuation_no=?");
$summarySql->bind_param("i", $valuationNumber);

$summarySql->execute();
$result = $summarySql->get_result();
$row = $result -> fetch_assoc();

$valuation_no = $row["valuation_no"];
$valuation_date = $row["valuation_date"];
$batch_report_no = $row["batch_report_no"];
$customer_id = $row["customer_id"];
$exchange_rate = $row["exchange_rate"];
$costs = $row["costs"];
$prepared_by = $row["prepared_by"];
$verified_by = $row["verified_by"];
$approved_by = $row["approved_by"];

// Fetching customer details
$sql = "SELECT customer_id, customer_name, contact_person, telephone, grn_no, grade_name, batch_order_input_qty
FROM batch_reports_summary
JOIN batch_processing_order USING (batch_order_no)
JOIN grn USING (batch_order_no)
JOIN customer USING (customer_id)
WHERE (batch_report_no=?)";

$stmt = $conn->prepare($sql);
$batchNo = $batch_report_no;
$stmt->bind_param("i", $batchNo);
$stmt->execute();
$customerResult = $stmt->get_result();
$customerDetials = $customerResult -> fetch_assoc();

$customer_name = $customerDetials["customer_name"];
$contact_person = $customerDetials["contact_person"];
$telephone = $customerDetials["telephone"];
$grn_no = $customerDetials["grn_no"];
$batchInputQty = $customerDetials["batch_order_input_qty"];

$totalQty = 0;
$totalYield = 0;

$totalUgxAMount = 0;
$totalUsdAmount = 0;



// Returning Grade details
function previousValuationItemRow(){
    global $conn, $valuationNumber, $exchange_rate, $totalUgxAMount, $totalUsdAmount, $totalQty, $totalYield, $batchInputQty;
    $valuationDetailsSql = "SELECT grades.grade_id AS id, grade_name, qty_in, price_ugx FROM nucafe_inventory
                        JOIN grades USING (grade_id)
                        WHERE document_type='Valuation Report' AND document_no=?";
    $detailsStmt = $conn -> prepare($valuationDetailsSql);
    $detailsStmt -> bind_param("i", $valuationNumber);
    $detailsStmt -> execute();
    $detailsStmt->bind_result($grade_id, $grade_name, $qty_in, $price_ugx);
    
    $allItems = $detailsStmt->get_result();
    $rows = $conn -> affected_rows; // No of items returned
    
    // Getting other prices
    $ctsConstant = 2.20462262185;

    
    
    for ($itemNo = 1; $itemNo <= $rows; $itemNo ++){
        $itemRow = $allItems -> fetch_assoc();
        $ugxPx = $itemRow["price_ugx"];
        $valQty = $itemRow["qty_in"];
        $valYield = ($valQty / $batchInputQty)*100;
        $totalQty += $valQty;
        $totalYield += $valYield;
        $usdPx = $ugxPx / $exchange_rate;
        $ctsPx = $usdPx * $ctsConstant;
        $ugxAmount = $ugxPx * $valQty; // Total ugx amount per item
        $totalUgxAMount += $ugxAmount; 
        $usdAmount = $usdPx * $valQty; //Total usd amount per item
        $totalUsdAmount += $usdAmount;


        echo '<tr>
        <td>
            <div id="item'.$itemNo.'Field" style="display: grid;" class="itemName">';
                echo '<input type="text" value="'.$itemRow["id"].'" id="highGrade'.$itemNo.'Code" readonly name="highGrade'.$itemNo.'Code" class="itmNameInput" style="grid-column: 1; display:none">';
                echo '<input type="text" value="'.$itemRow["grade_name"].'" id="highGrade'.$itemNo.'Name" readonly name="highGrade'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">
            
        </td>';
        echo '<td><input type="number" value="'.$valYield.'" id="highGrade'.$itemNo.'Yield" readonly name="highGrade'.$itemNo.'Yield" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$valQty.'" id="highGrade'.$itemNo.'Qty" readonly name="highGrade'.$itemNo.'Qty" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$usdPx.'" id="highGrade'.$itemNo.'PriceUs" readonly name="highGrade'.$itemNo.'PriceUs" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$ctsPx.'" id="highGrade'.$itemNo.'PriceCts" readonly name="highGrade'.$itemNo.'PriceCts" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$ugxPx.'" id="highGrade'.$itemNo.'PriceUgx" readonly name="highGrade'.$itemNo.'PriceUgx" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$usdAmount.'" id="highGrade'.$itemNo.'AmountUs" readonly name="highGrade'.$itemNo.'AmountUs" class="tableInput"></td>';
        echo '<td><input type="number" value="'.$ugxAmount.'" id="highGrade'.$itemNo.'AmountUgx" readonly name="highGrade'.$itemNo.'AmountUgx" class="tableInput"></td>
        </tr>';
  }
}




$previousValuationNo = $valuationNumber - 1; //nextDocNumber("valuation_report_summary", "valuation_no", "");
$nextValuationNo = $valuationNumber + 1;
?>

<form id="valuationForm" name="valuationForm" class="regularForm" style="height: 930px;" method="POST" action="../connection/valuation.php">
    <h3 class="formHeading">VALUATION REPORT</h3>
    <div style="padding: 15px 5px 5px 70%;">
        <label for="valuationNumber" id="valuationNumberLabel" class="valuationLabel" >Valuation No.:</label>


        <?php
            
        echo '<input type="text" id="valuationNumber" name="valuationNumber" class="shortInput" readonly value='.$valuation_no.' 
                style="width: 100px; text-align: center;"><br>';
        
        echo '<label for="valuationDate" id="valuationNumberLabel" class="valuationLabel" >Date:</label>';
        
        echo '<input type="text" id="valuationDate" name="valuationDate" class="shortInput" style="width: 100px; text-align: center;"
        value="'.$valuation_date.'" radonly><br>';
        ?>

        <label for="valuationGrnNumber" id="valuationNumberLabel" class="valuationLabel" >GRN No.:</label>
        <input type="text" id="valuationGrnNumber" class="shortInput" style="width: 100px; text-align: center;" value="<?php echo $grn_no ?>" readonly><br>
        
        <label for="batchNo" id="batchNoLabel" class="valuationLabel" >Batch No:</label>
        <input type="number" id="batchNo" name="batchNo" class="shortInput" value="<?php echo $batch_report_no; ?>" style="width: 100px; text-align: center;"
        onchange="updateOrder(this.value)" readonly>
    </div>
    <div>
        <label for="valuationSupplier" id="valuationSupplierLabel" class="regularLabel">Supplier:</label>
        <!-- <input type="text" id="valuationSupplier" name="valuationSupplier" class="longInputField" style="width: 400px;"><br> -->

        <input type="text" id="customerId" name="customerId" class="shortInput" readonly value="<?php echo $customer_id ?>" style="margin: 0px; width: 70px">
        <input type="text" id="valuationSupplier" name="valuationSupplier" class="longInputField" readonly value="<?php echo $customer_name ?>" style="margin: 0px; width: 300px">

        <?php
            echo '<select id="valuationClient" class="longInputField" name="batchReportClient" style="width: 20px; margin: 0px; display:none;"
            onchange="updateOrder(this.value)">';
            valuationCustomer();
            echo '</select><br>';
            
        ?>
        <label for="valuationContactPerson" id="valuationContactPersonLabel" class="regularLabel">Contact Person:</label>
        <input type="text" id="valuationContactPerson" class="longInputField" value="<?php echo $contact_person ?>" readonly>
        <label for="valuationTelephone" id="valuationTelephoneLabel" class="regularLabel" style="padding-left: 20px;">Telephone:</label>
        <input type="tel" id="valuationTelephone" class="longInputField" style=" width:150px" value="<?php echo '+256 '.$telephone; ?>" readonly><br>
    </div>
    <div id="ajaxDiv" style="display: none;"></div>
    
        <table id="valuationsTable">
            <tr>
                <th colspan="8">VALUATION SCHEDULE</th>
            </tr>
            <tr>
                <td>Kibooko Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="" id="kibookoQty" name="kibookoQty" class="tableInput"></td>
                <td colspan="3">FAQ Delivered (Kg)</td>
                <td colspan="2"><input type="number" value="<?php echo $batchInputQty ?>" id="FAQQty" name="FAQQty" class="tableInput"></td>
            </tr>
            <tr>
                <td>Exchange Rate</td>
                <td colspan="2"><input type="number" value=<?php echo $exchange_rate ?> id="exchangeRate" name="exchangeRate" class="tableInput" readonly></td>
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
            
            
            <?php previousValuationItemRow(); ?>
            
            
            <tr>
                <th>Actual Total Value Before Costs</th>
                <td><input type="number" value="<?php echo $totalYield; ?>" id="totalYield" readonly name="totalYield" class="tableInput"></td>
                <td><input type="number" value="<?php echo $totalQty; ?>" id="totalQty" readonly name="totalYield" class="tableInput"></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="number" value="<?php echo $totalUsdAmount; ?>" id="grandTotaltUs" readonly name="grandTotaltUs" class="tableInput"></td>
                <td><input type="number" value="<?php echo $totalUgxAMount; ?>" id="grandTotaltUgx" readonly name="grandTotaltUgx" class="tableInput"></td>
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
                
                <td><input type="number" value="<?php echo $costs / $exchange_rate; ?>" id="totalCostsUsd" readonly name="totalCostsUsd" class="tableInput"></td>
                <td><input type="number" value="<?php echo $costs; ?>" id="totalCostsUgx" readonly name="totalCostsUgx" class="tableInput"></td>
            </tr>
            <tr>
                <th colspan="6">Sub-total Costs</th>
                
                <td><input type="number" value="<?php echo $costs / $exchange_rate; ?>" id="subTotalCostsUsd" readonly name="subTotalCostsUsd" class="tableInput"></td>
                <td><input type="number" value="<?php echo $costs; ?>" id="subTotalCostsUgx" readonly name="subTotalCostsUgx" class="tableInput"></td>
            </tr>
            <tr>
                <th colspan="6">Total Value after Costs</th>
                
                <td><input type="number" value="<?php echo $totalUsdAmount-($costs / $exchange_rate); ?>" id="totalValueUsd" readonly name="totalValueUsd" class="tableInput"></td>
                <td><input type="number" value="<?php echo $totalUgxAMount-$costs; ?>" id="totalValueUgx" readonly name="totalValueUgx" class="tableInput"></td>
            </tr>
            
        </table>
    </div>
    <?php include_once("../private/approvalDetails.php"); ?>
</form>

<script>
    $(".controlButtons").hide();
    
</script>