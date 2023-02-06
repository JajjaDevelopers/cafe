<?php $pageTitle = "Stock Balances";?>
<?php require "../forms/header.php" ?>
<?php require "../connection/databaseConn.php" ?>
<?php ?>
<div class="regularForm" style="height: fit-content; width:fit-content; border-radius: 10px; width: 1000px">
    <h3 class="formHeading">Stock Balances</h3>
    <form style="height: fit-content; background-color:inherit; border:solid green 1px ">
        
        <div id="criteriaSelection" class="container">
            <div class="row">
                <div class="col-md-2">
                    <label for="type">Coffee Type:</label><br>
                    <select id="type" name="type" class="shortInput" onchange="itemFilterOptions('category',this.value, 'typeCat')">
                        <option value="all">All</option>
                        <option value="Arabica">Arabica</option>
                        <option value="Robusta">Robusta</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="category">Type Category:</label><br>
                    <select id="category" name="category" class="shortInput" style="width: 150px;"
                    onchange="itemFilterOptions('gradeId',this.value, 'grades')">
                        <option value="all">All</option>
                        
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="grade">Grade:</label><br>
                    <select id="gradeId" name="grade" class="shortInput" style="width: 250px;">
                        <option value="all">All</option>
                    
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date">As at:</label><br>
                    <input type="date" id="date" name="date" class="shortInput" style="width: 150px;" value="<?= $today?>">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                    <label for="customerId">Client:</label><br>
                    <select id="customerId" name="customerId" class="shortInput" style="width: 280px;">
                        <?php clientPicker() ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"><br>
                    <?php submitButton("Submit", "button", "confirm");?>
                </div>
            </div>
        </div>
    </form>
    <div class="container text-center">
        <form action="../phpspreadsheet/export.php" method="post" style="display:none; background-color:inherit;border:none;" id="export">
            <div class="form-group text-end">
            <input type="submit" name="export" value="Export to Excel" class="btn" style="background-color:green; color:white; margin-right: 0px;">
            </div>
        </form>
    </div>
    <div id="stockBalanceReturns" class="container">

    </div>
</div>

<?php require "../forms/footer.php" ?>
<script src="../assets/js/itemsFilter.js"></script>
<script>
    document.getElementById("verifyBtn").addEventListener("click", getStockBalance);
    function getStockBalance(){
        var coffType = document.getElementById("type").value;
        var typCategory = document.getElementById("category").value;
        var coffGrade = document.getElementById("gradeId").value;
        var atDate = document.getElementById("date").value;
        var forCLient = document.getElementById("customerId").value;


        const xhttp = new XMLHttpRequest();
        // Updating grades based on coffee type
        xhttp.onload = function() {
          document.getElementById("stockBalanceReturns").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/stockBalance.php?type="+coffType+"&category="+typCategory+"&grade="+
                coffGrade+"&date="+atDate+"&client="+forCLient);
      xhttp.send();
      document.getElementById("export").style.display="block";
    }

</script>