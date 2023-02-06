<?php $pageTitle = "Stock Transactions";?>
<?php
include "../forms/header.php";
include "../private/database.php";
?>
<form class="regularForm" style="height: fit-content; width: 1000px; ">
    <h3 class="formHeading">Stock Transactions</h3>
    <div id="criteriaSelection" class="container" style="border: 1px solid green; border-radius: 10px; padding: 10px">
        <div class="row">
            <div class="col-md-4">
                <label for="type">Coffee Type:</label><br>
                <select id="type" name="type" class="shortInput"
                onchange="itemFilterOptions('category',this.value, 'typeCat')" style="width: 150px;">
                    <option value="all">All</option>
                    <option value="Arabica">Arabica</option>
                    <option value="Robusta">Robusta</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category">Type Category:</label><br>
                <select id="category" name="category" class="shortInput" style="width: 150px;"
                onchange="itemFilterOptions('gradeId',this.value, 'grades')">
                    <option value="all">All</option>
                    
                </select>
            </div>
            <div class="col-md-4">
                <label for="gradeId">Grade:</label><br>
                <select id="gradeId" name="gradeId" class="shortInput" style="width: 250px;">
                    <option value="all">All</option>
                   
                </select>
            </div>
            
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <label for="fromDate">Date From:</label><br>
                <input type="date" id="fromDate" name="fromDate" class="shortInput" style="width: 150px;" value="<?=$fromDate?>">
            </div>
            <div class="col-md-4">
                <label for="toDate">Date To:</label><br>
                <input type="date" id="toDate" name="toDate" class="shortInput" style="width: 150px;" value="<?=$today?>">
            </div>
            <div class="col-md-4">
                <label for="customerId">Client:</label><br>
                <select id="customerId" name="customerId" class="shortInput" style="width: 250px;">
                   
                    <?php clientPicker(); ?>
                   
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><br>
                <?php submitButton("Submit", "button", "confirm");?>
            </div>
        </div>
    </div>
    <div id="stockBalanceReturns" class="container">

    </div>
</form>
    <script src="../assets/js/itemsFilter.js"></script>
<script>
    document.getElementById("verifyBtn").addEventListener("click", getStockTransactions);
    function getStockTransactions(){
        var coffGrade = document.getElementById("gradeId").value;
        var clientId = document.getElementById("customerId").value;
        var frmDate = document.getElementById("fromDate").value;
        var toDte = document.getElementById("toDate").value;


        const xhttp = new XMLHttpRequest();
        // Updating grades based on coffee type
        xhttp.onload = function() {
          document.getElementById("stockBalanceReturns").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/stockTransactions.php?grd="+coffGrade+"&client="+clientId+"&frmDt="+
                frmDate+"&toDt="+toDte);
      xhttp.send();
    }
</script>







<?php include "../forms/footer.php";?>