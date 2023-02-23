<script>
      //disabling editing
    var noEditList = ["itmName", "inputQty", "inputMc", "outputQty", "outputMc", "dryLoss", "percLoss", "notes", "dryingNo", "dryingDate"];
    for (var x=0; x<noEditList.length; x++){
        document.getElementById(noEditList[x]).setAttribute("readonly", "readonly");
    }
    var noDisplayList = ["itemCode", "salesReportBuyer"];
    for (var x=0; x<noDisplayList.length; x++){
        document.getElementById(noDisplayList[x]).style.display = "none";
    }
    
</script>