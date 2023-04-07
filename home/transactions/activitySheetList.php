<?php $pageTitle = "Roastery Activities";?>
<?php require "../forms/header.php" ?>
<?php require "../connection/databaseConn.php" ?>
<form class="regularForm" style="width: 1000px; height:fit-content">
    <h3 class="formHeading">Roastery Activities</h3>
    <div class="container" style="border: 1px solid green; border-radius:10px">
        <div class="row">
            <div class="col-sm-3">
                <label>From Date</label><br>
                <input type="date" id="frmDate" name="frmDate" class="shortInput" value="<?=$fromDate?>" style="width: 150px;">
            </div>
            <div class="col-sm-3">
                <label>To Date</label><br>
                <input type="date" id="toDate" name="toDate" class="shortInput" value="<?=$today?>" style="width: 150px;">
            </div>
            <div class="col-sm-6">
                <label>Customer</label><br>
                <select id="customerId" name="customerId" class="shortInput" style="width: 300px;">
                    <?php clientPicker(); ?>
                </select>
            </div>
        </div>
        <?php submitButton("Submit", "button", "confirm") ?>
    </div>
    
    <div id="results" style="margin-top: 40px;">

    </div>

</form>
<?php include "../forms/footer.php" ?>
<script>
    document.getElementById("verifyBtn").addEventListener("click", getGrnList);
    function getGrnList(){
        var frmDt = document.getElementById('frmDate').value;
        var toDt = document.getElementById('toDate').value;
        var clientId = document.getElementById('customerId').value;
        
        const xhttp = new XMLHttpRequest();
        // Updating grades based on coffee type
        xhttp.onload = function() {
          document.getElementById("results").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/activitySheet.php?fun=list&startDate="+frmDt+"&endDate="+toDt+"&custId="+clientId);
      xhttp.send();
    }
</script>