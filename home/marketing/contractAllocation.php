<?php $pageTitle="Contract Allocation";
include_once ("../forms/header.php");
include ("../connection/databaseConn.php");
$newBatchNo = nextDocNumber("contract_stock_allocation", "allocation_no", "ALC");
?>
<form class="regularForm" method="post" action="../connection/contractOffer.php" style="width: 900px; height:fit-content">
    <h3 class="formHeading">Contract Allocation</h3>
    <div style="margin-left: 70%">
        <label for="alloctNo">Alloc No.:</label>
        <label id="alloctNo" class="shortInput" name="alloctNo"><?=$newBatchNo ?></label><br>
        <label for="date">Date</label>
        <input type="date" id="date" class="shortInput" name="date" value="<?= $today ?>"><br>
        
        <br>
    </div>
    <?php include "../forms/customerSelector.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <label for="reference">Reference</label><br>
                <select type="text" id="reference" name="reference" class="shortInput" style="width: 150px;" onchange="contractSummary()">
                    <option value="">--Select Reference--</option>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
                <label for="contNo">Number</label><br>
                <input type="text" id="contNo" name="contNo" readonly class="shortInput" style="width: 200px;">
            </div>
            <div class="col-sm-4">
                <label for="currency">Currency</label><br>
                <input type="text" id="currency" readonly name="currency" class="shortInput" style="width: 150px;">
            </div>
            <div class="col-sm-4">
                <label for="incoterms">Incoterms</label><br>
                <input type="text" id="incoterms" name="incoterms" readonly class="shortInput" style="width: 150px;">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <label for="country">Country</label><br>
                <input type="text" id="country" name="country" readonly class="shortInput" style="width: 200px;">
            </div>
            <div class="col-sm-4">
                <label for="shipdDate">Shipment Date</label><br>
                <input type="text" value="" id="shipdDate" name="shipdDate"readonly  name="total" class="shortInput" style="width: 150px;">
            </div>
            <div class="col-sm-4">
                <label for="fulfilled">Fulfillment</label><br>
                <input type="text" id="fulfilled" name="fulfilled" readonly class="shortInput" style="width: 150px;">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-12">
            <table>
        <thead>
            <tr>
                <th style="width: 20px;">#</th>
                <!-- <th >Item Code</th> -->
                <th style="width: 300px;">Item Description</th>
                <th style="width: 80px;">Contract Qty (Kg)</th>
                <th style="width: 80px;">Allocated Qty (Kg)</th>
                <th style="width: 80px;">Balance</th>
                <th style="width: 150px;">Source</th><!-- either valuation or open source -->
                <th style="width: 80px;">Available Qty (Kg)</th>
                <th style="width: 80px;">Allocation Qty (Kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($x=1;$x<=10;$x++){ //check the length of pick item function
                ?>
                <tr>
                    <td><?=$x?></td>
                    <input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px; display:none">
                    <td>
                        <div id="<?='item'.$x.'Field'?>" style="display: grid;">
                            <input type="text" value="" id="<?='item'.$x.'Name'?>" readonly name="<?='item'.$x.'Name'?>" class="itmNameInput" style="grid-column: 1; width: 270px">
                            <select id="<?='item'.$x.'Select'?>" style="margin: 0px; width: 20px; grid-column: 2;" class="itemSelect" onchange="pickItem(<?=$x?>)">
                                <?php //CoffeeGrades();?>
                            </select>
                        </div>
                    </td>
                    <td><input type="number" value="" id="<?='item'.$x.'ReqQty'?>" readonly name="<?='item'.$x.'ReqQty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'AllocQty'?>" readonly name="<?='item'.$x.'AllocQty'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'BalQty'?>" readonly name="<?='item'.$x.'BalQty'?>" step="0.001" class="tblNum"></td>
                    <td>
                        <select type="number" value="" id="<?='item'.$x.'Src'?>" name="<?='item'.$x.'Src'?>" step="0.001" class="tableInput">
                            <option value=""></option>
                            <option value="Open">Open</option>
                        </select>
                    </td>
                    <td><input type="number" value="" id="<?='item'.$x.'SrcQty'?>" name="<?='item'.$x.'SrcQty'?>" step="0.001" class="tblNum"></td>
                    <td><input type="number" value="" id="<?='item'.$x.'DistQty'?>" readonly name="<?='item'.$x.'DistQty'?>" step="0.001" class="tblNum"></td>

                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="2">Total</th>
                <td><input type="number" value="" id="ReqQty" readonly name="totalQty" class="tblNum"></td>
                <td><input type="number" value="" id="AllocQty" readonly name="totalQty" class="tblNum"></td>
                <td><input type="number" value="" id="BalQty" readonly name="totalQty" class="tblNum"></td>
                <th></th>
                <td><input type="number" value="" id="SrcQty" readonly name="total" class="tblNum"></td>
                <td><input type="number" value="" id="DistQty" readonly name="totalQty" class="tblNum"></td>
            </tr>
        </tbody>
    </table>
            </div>
        </div>
    </div>


    <?php submitButton("Submit", "submit", "btnsubmit") ?>
</form>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById("salesReportBuyer").addEventListener("change", getReferences);
    //update summary
    function contractSummary(){
        var contNum = document.getElementById("reference").value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            var contSummary =  JSON.parse(this.responseText);
            document.getElementById("country").setAttribute('value', contSummary[0]);
            document.getElementById("contNo").setAttribute('value', contNum);
            document.getElementById("shipdDate").setAttribute('value', contSummary[1]);
            document.getElementById("incoterms").setAttribute('value', contSummary[2]);
            document.getElementById("currency").setAttribute('value', contSummary[5]);
            var reqQty = Number(contSummary[3]);
            var allocQty = Number(contSummary[4]);
            var fulfillRate = (allocQty*100/reqQty).toLocaleString() ;
            document.getElementById("fulfilled").setAttribute('value', contSummary[4]+'Kg ('+fulfillRate+'%)');
            getItems();
            
        }
        xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getSummary");
        xhttp.send();

    }

    function getReferences(){
        //var contReference = document.getElementById('reference').value;
        var contClient = document.getElementById("customerId").value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById("reference").innerHTML=this.responseText;
        }
        xhttp.open("GET", "../ajax/contractManager.php?clt="+contClient+"&q=getReference");
        xhttp.send();

    }

    //get contract items
    function getItems(){
        var contNum = document.getElementById("reference").value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            for (var x=1;x<=10;x++){
                document.getElementById("item"+x+"Select").innerHTML=this.responseText;
            }
            
        }
        xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getItems");
        xhttp.send();

    }

    function pickItem(x){
        var contNum = document.getElementById("reference").value;
        var selectedItem = document.getElementById('item'+x+'Select').value;
        var id=selectedItem.slice(0,6);
        document.getElementById('item'+x+'Code').setAttribute("value", id);
        document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(6));
        
        const xhttp = new XMLHttpRequest();
        
        xhttp.onload = function(){
            var qtyValues = JSON.parse(this.responseText);
            document.getElementById("item"+x+"ReqQty").setAttribute("value", qtyValues[0]);
            document.getElementById("item"+x+"AllocQty").setAttribute("value", qtyValues[1]);
            document.getElementById("item"+x+"BalQty").setAttribute("value", qtyValues[2]);
            getValuations(x);
    
        }
        xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getQtys&grd="+id);
        xhttp.send();
    }

    //get valuations available
    function getValuations(x){
        // var allocQty = Number(document.getElementById('item'+x+'AllocQty').value);
        var contNum = document.getElementById("reference").value;
        var selectedItem = document.getElementById('item'+x+'Select').value;
        var id=selectedItem.slice(0,6);
        document.getElementById('item'+x+'Code').setAttribute("value", id);
        document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(6));
        
        const xhttp = new XMLHttpRequest();
        
        xhttp.onload = function(){
            document.getElementById("item"+x+"Src").innerHTML=this.responseText;
        }
        xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getVal&grd="+id);
        xhttp.send();
    }

</script>