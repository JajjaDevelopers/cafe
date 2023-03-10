<?php $pageTitle="Select Batch Order"; ?>
<?php include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
include ("../ajax/batchReportReturnsAjax.php");
?>
<form id="batchReportForm" class="regularForm"action="batchReport.php" method="POST" style="width: 700px;">
    <h3 id="batchReportHeading" class="formHeading">Batch Order Selection</h3>
    <?php
        include "../alerts/message.php";
     ?>
    <div id="ajaxDiv1" style="display: none">
        
    </div>
    <div style="display: grid;">
        <div style="grid-row: 1; grid-column: 1; padding-top: 50px; margin-bottom: 5px; ">
            <?php require("../connection/batchReportCustomer.php"); ?>
        </div>
        <div style="display: grid;">
            <label for="batchOrderNumber" style="grid-row: 1; grid-column: 1; margin-top: 10px">Order No.:</label>
            <select type="text" id="batchOrderNumber" class="shortInput" name="batchOrderNumber" style="grid-row: 2; grid-column: 1; margin-top: 0px;">

            </select>

            <label for="orderDate" style="grid-row: 1; grid-column: 2; margin-top: 10px;">Date:</label>
            <input type="text" id="orderDate" name="orderDate" readonly class="shortInput" style="grid-row: 2; grid-column: 2; margin-top: 0px;">

            <label for="coffeeType" style="grid-row: 1; grid-column: 3; margin-top: 10px;">Type:</label>
            <input type="text" id="coffeeType" name="coffeeType" readonly class="shortInput" style="grid-row: 2; grid-column: 3; margin-top: 0px;"><br>

            <label for="coffeeGrade" style="grid-row: 3; grid-column: 1; margin-top: 10px;" >Grade:</label>
            <input type="text" id="coffeeGrade" name="coffeeGrade" readonly class="shortInput" style="grid-row: 4; grid-column: 1; margin-top: 0px; width: 200px">

            <label for="inputQty" style="grid-row: 3; grid-column: 2; margin-top: 10px;">Quantity (Kg):</label>
            <input type="number" id="inputQty" name="inputQty" readonly class="shortInput" style="grid-row: 4; grid-column: 2; margin-top: 0px;">

            <label for="batchMc" style="grid-row: 3; grid-column: 3; margin-top: 10px;">MC:</label>
            <input type="text" id="batchMc" name="batchMc" readonly class="shortInput" style="grid-row: 4; grid-column: 3; margin-top: 0px;">
            
        </div>
        <input type="text" id="gradeId" name="gradeId" readonly class="shortInput"style="display: none" >
        <div id="batchSummary">

        </div>
    </div>
    <?php submitButton("Next", "submit", "btnSubmit") ?>
    </form>
<?php include_once ("../forms/footer.php")?>
    <script>
    //pick available customer orders
    document.getElementById("salesReportBuyer").addEventListener('change', checkCustomerOrders);
    
    function checkCustomerOrders(){
        var customerId = document.getElementById("customerId").value;
        if (customerId == "") {
            document.getElementById("batchOrderNumber").setAttribute('value', '');
            return;
        } 
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("batchOrderNumber").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../ajax/batchReportOrdersAjax.php?q="+customerId);
        xhttp.send();
    }
    


    // Get coffee type of the order
    document.getElementById("batchOrderNumber").addEventListener('change', updateOrder);
    function updateOrder(){
        var str = document.getElementById("batchOrderNumber").value;
        if (str == "") {
            document.getElementById("inputQty").setAttribute('value', '');
            document.getElementById("batchReportMcIn").setAttribute('value', '');
            return;
        } 
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            var batchData = JSON.parse(this.responseText);
            document.getElementById("coffeeType").setAttribute("value", batchData[0]);
            document.getElementById("coffeeGrade").setAttribute("value", batchData[5]);
            document.getElementById("inputQty").setAttribute("value", batchData[2]);
            document.getElementById("batchMc").setAttribute("value", batchData[3]);
            document.getElementById("orderDate").setAttribute("value", batchData[4]);
            document.getElementById("gradeId").setAttribute("value", batchData[1]);
            

        }
        xhttp.open("GET", "../ajax/batchCoffeeTypeAjax.php?q="+str);
        xhttp.send();
        getBatchReturns(str);
    }


    //Batch returns
    function getBatchReturns(no){
        
        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("batchReturnsAjax").innerHTML = this.responseText;

            var receivedJson = document.getElementById("allIdsJson").innerHTML;
            var gradeLists = JSON.parse(receivedJson);
            document.getElementById("checkDiv").innerHTML = gradeLists[0][0];
        }
        xhttp.open("GET", "../ajax/batchReportReturnsAjax.php?q="+no);
        xhttp.send();
    }

</script>

