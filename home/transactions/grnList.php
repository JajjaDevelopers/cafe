<?php $pageTitle = "Previous GRNs";?>
<?php require "../forms/header.php" ?>
<?php require "../connection/databaseConn.php" ?>
<form class="regularForm" style="width: 1000px; height:fit-content">
    <h3 class="formHeading">Previous GRNs</h3>
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
    
</form>
<div class="container text-center d-flex flex-column align-items-end">
        <div>
            <form action="../phpspreadsheet/previousgrnExport.php" method="post" style="display:none; background-color:inherit;border:none;" id="grnexcel">
                <div class="form-group text-end">
                <input type="submit" name="export" value="Export to Excel" class="btn" style="background-color:green; color:white; margin-right: 0px;">
                </div>
            </form>
        </div>
        <div class=" mt-3 me-5">
            <a href="../pdfgen/previousgrn.php" target="_blank"  id="grnpdf" style="display:none;">
                <i class="bi bi-download" style="color:green; font-size:30px">
                </i>
            </a>
        </div>
      
</div>
<div id="results" style="margin-top: 40px;">

</div><!---div for displaying results-->
<?php include "../forms/footer.php" ?>
<script>
    
    document.getElementById("verifyBtn").addEventListener("click", getGrnList);
    function getGrnList(){
        document.getElementById("grnpdf").style.dislay="none"
        var frmDt = document.getElementById('frmDate').value;
        var toDt = document.getElementById('toDate').value;
        var clientId = document.getElementById('customerId').value;
        
        const xhttp = new XMLHttpRequest();
        // Updating grades based on coffee type
        xhttp.onload = function() {
          document.getElementById("results").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../ajax/grnList.php?startDate="+frmDt+"&endDate="+toDt+"&custId="+clientId);
      xhttp.send();
      
      document.getElementById("grnpdf").style.display="block";
      document.getElementById("grnexcel").style.display="block";
    }
</script>