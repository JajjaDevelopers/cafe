<?php
$pageTitle = "Batch Order Clients";
include "../connection/databaseConn.php";
include "../forms/header.php";
$batchOrderNo = nextDocNumber("batch_processing_order", "batch_order_no", "BOD");
?>
<form class="regularForm" method="post" action="../connection/batchProcessingOrder.php" style="height: fit-content;">
    <h3 class="formHeading">Batch Order Clients</h3>
    <div style="display: grid; width:fit-content; margin-left: 70%; margin-bottom:20px">
        <label for="dryingNo" style="grid-column: 1; grid-row: 1; width:70px; margin-top: 5px">Order No:</label>
        <input type="text" class="shortInput" id="dryingNo" name="dryingNo" readonly required value="<?= $batchOrderNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="dryingDate" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="orderDate" name="orderDate" required value="<?= $today ?>" style="grid-column: 2; grid-row: 2">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <label>Activity:</label>
                <select id="activity" name="activity" class="shortInput" style="width: 200px;" onchange="setGrade()">
                    <option value="Grading">Grading and Color Sorting</option>
                    <option value="Hulling">Hulling</option>
                    <option value="Drying">Drying</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Input Grade:</label>
                <select id="inputGrade" name="inputGrade" class="shortInput" style="width: 200px;" onchange="getClients()">
                    <?php selectCoffeeGrades() ?>
                </select>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th style="width: 350px;">Client</th>
                <th style="width: 100px;">GRN</th>
                <th style="width: 80px;">MC (%)</th>
                <th style="width: 100px;">Qty (Kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($x=1;$x<=5;$x++){
                ?>
                <tr>
                    <td style="text-align: center;"><?=$x."."?></td>
                    <td><select id="<?='client'.$x.'Id'?>" name="<?='client'.$x.'Id'?>?>" class="tableInput" 
                    onchange="getGrnDetails('<?=$x?>', 'getGrns', '<?='client'.$x.'Grn'?>')"></select></td>
                    <td><select id="<?='client'.$x.'Grn'?>" name="<?='client'.$x.'Grn'?>" class="tableInput" 
                    onchange="getGrnDetails('<?=$x?>', 'getQty', '<?='client'.$x.'Qty'?>')"></select></td>
                    <td>
                        <input type="number" id="<?='client'.$x.'Mc'?>" name="<?='client'.$x.'Mc'?>" class="tblNum" step="0.01" onchange="getTotal()">
                    </td>
                    <td>
                        <input type="number" id="<?='client'.$x.'Qty'?>" name="<?='client'.$x.'Qty'?>" class="tblNum" step="0.01" onchange="getTotal()">
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="3" style="text-align: center;">Total</th>
                <th><input type="number" id="avgMc" name="avgMc" class="tblNum" step="0.01" readonly></th>
                <th><input type="number" id="batchTotalQty" name="batchTotalQty" class="tblNum" step="0.01" readonly></th>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="startDate" class="shortInput" value="<?=$today?>" required>
                <label for="startTime">Time</label>
                <input type="time" id="startTime" name="startTime" class="shortInput" required>
            </div>
            <div class="col-sm-6">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="endDate" class="shortInput" value="<?=$today?>" required>
                <label for="endTime">Time</label>
                <input type="time" id="endTime" name="endTime" class="shortInput" required>
            </div>
        </div>
    </div>
    <?php submitButton("Submit", "submit", "btnsubmit") ?>
    <input value="multiClient" name="combination" style="display: none;" readonly>
</form>
<?php
include "../forms/footer.php";
?>
<script>
    function getClients(){
        var inputGrd = document.getElementById("inputGrade").value;
        const xhttp = new XMLHttpRequest();
        // Updating clients based on grades
        xhttp.onreadystatechange  = function() {
            for (var x=1;x<=5;x++){
                document.getElementById('client'+x+'Id').innerHTML=this.responseText;
            }
        }
        xhttp.open("GET", "../ajax/clientGrnPicker.php?selFun=getClient&selGrade="+inputGrd);
        xhttp.send();
        setGrade();
    }


    function setGrade(){
        for (var x=1;x<=5;x++){
            document.getElementById('client'+x+'Qty').setAttribute("value", "");
            document.getElementById('client'+x+'Mc').setAttribute("value", "");
            document.getElementById('client'+x+'Id').value='';
            document.getElementById('client'+x+'Grn').value='';
        }
        getTotal();
    }

    function getTotal(){
        var total = 0;
        var batchMc = 0;
        var nonZero = 0;
        for (var x=1;x<=5;x++){
            var grdQty = Number(document.getElementById('client'+x+'Qty').value);
            total += grdQty;
            var grdMc = Number(document.getElementById('client'+x+'Mc').value);
            if (grdQty>0){
                nonZero+=1;
                batchMc+=grdMc;
            }
        }
        document.getElementById("batchTotalQty").setAttribute("value", total);
        document.getElementById("avgMc").setAttribute("value", batchMc/nonZero);
    }

    //getting grns
    function getGrnDetails(index, fun, dependant){
        var selectCustomer = document.getElementById('client'+index+'Id').value;
        var inputGrd = document.getElementById("inputGrade").value;
        var selectedGrn = document.getElementById('client'+index+'Grn').value;
        
        function getGrnMc(){
            const xhttp2 = new XMLHttpRequest();
            // Updating grades based on filters
            xhttp.onreadystatechange  = function() {
                document.getElementById('client'+index+'Mc').setAttribute("value", (this.responseText))
                getTotal();
            }
            xhttp.open("GET", "../ajax/clientGrnPicker.php?selFun=getGrn&selGrn="+selectedGrn);
            xhttp.send();
            
        }

        const xhttp = new XMLHttpRequest();
        // Updating grades based on filters
        xhttp.onreadystatechange  = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (dependant=="client"+index+"Qty"){
                    document.getElementById(dependant).setAttribute("value", (this.responseText));
                    getGrnMc();
                    
                }else{
                    document.getElementById(dependant).innerHTML = this.responseText;
                    document.getElementById('client'+index+'Mc').setAttribute("value", "");
                    document.getElementById('client'+index+'Qty').setAttribute("value", "");
                    getTotal();
                }
            }
        }
        xhttp.open("GET", "../ajax/clientGrnPicker.php?selGrade="+inputGrd+"&selClient="+selectCustomer+"&selFun="+fun+"&selGrn="+selectedGrn);
        xhttp.send();
    }
</script>