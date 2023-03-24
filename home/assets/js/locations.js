//Getting districts
function getRegionDistricts(regionInputId){
    var region = document.getElementById(regionInputId).value;
    const districtRequest = new XMLHttpRequest();
    districtRequest.onload = function(){
        document.getElementById("district").innerHTML = this.responseText;
        // document.getElementById("newClientId").setAttribute("value", this.responseText);
    }
    districtRequest.open("GET", "../ajax/districtsAjax.php?q="+region);
    districtRequest.send();
}

//Getting countries
function getCountry(){
    var continent = document.getElementById("continent").value;
    const districtRequest = new XMLHttpRequest();
    districtRequest.onload = function(){
        document.getElementById("country").innerHTML = this.responseText;
    }
    districtRequest.open("GET", "../ajax/districtsAjax.php?q="+continent+"&req=country");
    districtRequest.send();
}
getCountry();