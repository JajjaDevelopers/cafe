function locationFilters(selectId, selectValue, filterFunc){
    document.getElementById("origin").innerHTML = '<option value="all">All</option>';
    const xhttp = new XMLHttpRequest();
    // Updating grades based on filters
    xhttp.onreadystatechange  = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById(selectId).innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "../ajax/locationsFilter.php?filter="+filterFunc+"&key="+selectValue);
    xhttp.send();
}   