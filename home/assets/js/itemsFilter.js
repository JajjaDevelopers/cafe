function itemFilterOptions(selectId, selectValue, filterFunc){
    var selectedType =  document.getElementById("type").value;
    document.getElementById("gradeId").innerHTML = "";
    
    const xhttp = new XMLHttpRequest();
    // Updating grades based on filters
    xhttp.onreadystatechange  = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById(selectId).innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "../ajax/itemFilters.php?filter="+filterFunc+"&key="+selectValue+"&selType="+selectedType);
    xhttp.send();
} 
    //get pre-offloading sample
    function getPreOffSampleNo(){
        document.getElementById("preOffSample").innerHTML = "";
        var custId = document.getElementById("customerId").value;
        var purpSelect = document.getElementById("purpose").value;
        var grd = document.getElementById("gradeId").value;
        if (custId == " ") {
            return;
        } 
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("preOffSample").innerHTML = this.responseText;
        }
        if (purpSelect == 'Processing' || purpSelect == 'Sale'){
          xhttp.open("GET", "../ajax/preOffloadSamp.php?q="+custId+"&selGrd="+grd);
          xhttp.send();
        }
      }
 