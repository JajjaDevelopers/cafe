<?php $pageTitle="Activity Sheet"; ?>
<?php include_once('header.php'); ?>
<?php
include ("../connection/databaseConn.php");
$activityNo = nextDocNumber("roastery_activity_summary", "activity_sheet_no", "RST");
?>

<form class="regularForm" action="../connection/activitySheet.php" method="POST" style="height: fit-content;">
   
    <h3 id="activitySheetHeading" class="formHeading">Roasting Order Form</h3>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="rostingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Activity No:</label>
        <input type="text" class="shortInput" id="rostingNo" name="rostingNo" value="<?= $activityNo?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="rostingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="rostingDate" name="rostingDate" value="" style="grid-column: 2; grid-row: 2">
    </div>
    <?php include("../forms/customerSelector.php") ?>
    
    <div id="servicesTable" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12"><label for="inputQty">Input</label></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <label for="inputGrade">Input Grade</label>
                    <select id="inputGrade" name="inputGrade" class="shortInput" style="width: 250px;">
                        <?php coffeeGrades(); ?>
                    </select>
                    <label for="inputQty" style="padding-left: 20px;" >Quantity</label>
                    <input type="number" id="inputQty" name="inputQty" class="shortInput" step="0.01">
                </div>
            </div>
        </div>
        <h5>Activities</h5>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr>
                    <th style="width: 350px;">Activity Name</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Rate</th>
                    <th style="width: 150px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for ($row = 1; $row <= 10; $row ++){
                        activityServices($row);
                    }
                ?>
            
                <tr id="totalRow">
                    <td class="emptyCell"></td>
                    <td class="emptyCell"></td>
                    <th>Total</th>
                    <th><input type="text" id="totalAmount" name="totalAmount" class="tableInput" readonly></th>
                </tr>
            </tbody>
        </table>
    </div>

    <div  id="inventoryTable" style="display: none;">
        <h5>Output Items</h5>
        <table class="w-75 table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr>
                    <th style="width: 400px;">Item Name</th>
                    <th style="width: 100px;">Output Qty</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php 
                for ($row = 1; $row <= 10; $row ++){ //script for creating items should be adjusted to match $row value
                    activitySheetItems($row);
                }
            ?>
            </tbody>
        </table>
    </div>

    <table style="margin-top: 30px; width: 100%">
        <tr>
            <th>Special Requests</th>
            <th>Coffee Roast Profile</th>
        </tr>
        <tr>
            <td><input type="text" id="specialRequest" class="remarks" name="specialRequest"></td>
            <td><input type="text" id="roastProfile" class="remarks" name="roastProfile"></td>
        </tr>
    </table>
    <div style="display: grid;">
        <div id="previousButton" style="grid-column: 1; grid-row: 1; display: none">
            <input type="button" value="Back" class="btn  btn-primary my-3 btn-lg text-white" name="btnsubmit">
        </div>
        <div id="nextButton" style="grid-column: 2; grid-row: 1;">
            <input type="button" value="Next" class="btn  btn-primary my-3 btn-lg text-white" name="btnsubmit">
        </div>
        <div id="submitButton" style="grid-column: 2; grid-row: 1; display: none">
            <?php include "../forms/submitButton.php" ?>
        </div>
    </div>
    
   
</form>
<?php include_once('footer.php'); ?>
<script>
    //create item ids
    var itmCodeList = [];
    var itmNameList = [];
    var itmSelectList = [];
    var itmQtyList = [];
    var itmRateList = [];
    var itmAmountList = [];
    // let responders = qtyList.concat(rateList);

    for (var x=1; x<=10; x++){ 
        itmCodeList.push("itm"+x+"Code");
        itmNameList.push("itm"+x+"Name");
        itmSelectList.push("itm"+x+"Select");
        itmQtyList.push("itm"+x+"Qty");
        itmRateList.push("itm"+x+"Rate");
        itmAmountList.push("itm"+x+"Amount");
    }

    //create service ids
    var svcCodeList = [];
    var svcNameList = [];
    var svcSelectList = [];
    var svcQtyList = [];
    var svcRateList = [];
    var svcAmountList = [];
    var svcQtyAndRateList = svcQtyList.concat(svcRateList);

    for (var x=1; x<=10; x++){ 
        svcCodeList.push("svc"+x+"Code");
        svcNameList.push("svc"+x+"Name");
        svcSelectList.push("svc"+x+"Select");
        svcQtyList.push("svc"+x+"Qty");
        svcRateList.push("svc"+x+"Rate");
        svcAmountList.push("svc"+x+"Amount");
    }

    //item selection
    function selectItemx(itmSelectId){
        
        var selectedItem = document.getElementById(itmSelectId).value;
        var selectedIndex = itmSelectList.indexOf(itmSelectId);

        document.getElementById(itmCodeList[selectedIndex]).setAttribute("value", selectedItem.slice(0,6));
        document.getElementById(itmNameList[selectedIndex]).setAttribute("value", selectedItem.substr(8));
    }

    // service selection
    function selectService(svcSelectId){
        
        var selectedItem = document.getElementById(svcSelectId).value;
        var selectedIndex = svcSelectList.indexOf(svcSelectId);

        document.getElementById(svcCodeList[selectedIndex]).setAttribute("value", selectedItem.slice(0,6));
        document.getElementById(svcNameList[selectedIndex]).setAttribute("value", selectedItem.substr(8));
    }
    
    //updating qty and price
    function updateQty(){
        var totalAmt = 0;
        for (var x=0; x<svcCodeList.length; x++){
            var qty = Number(document.getElementById(svcQtyList[x]).value);
            var rate = Number(document.getElementById(svcRateList[x]).value);
            var total = qty*rate;
            if (svcNameList[x] != "" ){
                document.getElementById(svcAmountList[x]).value = total;
                totalAmt += total;
            }else{
                document.getElementById(svcQtyList[x]).value = "";
                document.getElementById(svcRateList[x]).value = "";
                document.getElementById(svcAmountList[x]).value = "";
            }
        }
        document.getElementById("totalAmount").value = totalAmt;
    }


    //Toggling between tables
    var nextBtn = document.getElementById("nextButton");
    var nextTbl = document.getElementById("inventoryTable");
    var prevTbl = document.getElementById("servicesTable");
    var sbmtBtn = document.getElementById("submitButton");
    var prevBtn = document.getElementById("previousButton");

    function switchToInventory(){
        nextBtn.style.display = "none";
        prevTbl.style.display = "none";
        nextTbl.style.display = "block";
        sbmtBtn.style.display = "block";
        prevBtn.style.display = "block";
    }

    //previous table display
    
    function switchToServices(){
        nextBtn.style.display = "block";
        prevTbl.style.display = "block";
        nextTbl.style.display = "none";
        sbmtBtn.style.display = "none";
        prevBtn.style.display = "none";
    }


    document.getElementById("nextButton").addEventListener("click", switchToInventory);
    document.getElementById("previousButton").addEventListener("click", switchToServices);
</script>

