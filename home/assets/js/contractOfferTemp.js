// function changeIncoterm(){
var selTerm = document.getElementById("incoterms").value;
var selPort = document.getElementById("port").value;
const selPxRef = document.getElementById("pxRefHeader");
if (selTerm=="FOT"){
    selPxRef.innerText = "Price USD per MT FOT Kampala";
}else if (selTerm=="CIF" || selTerm=="CFR"){
    selPxRef.innerText = "Price USD per MT "+selTerm+" "+selPort;
    // document.getElementById("port").removeAttribute("readonly")
}else if (selTerm=="FOB"){
    selPxRef.innerText = "Price USD per MT FOB Mombasa";
}else if (selTerm=="Ex-Warehouse"){
    selPxRef.innerText = "Price USD per MT Ex-Warehouse";
    
}
// }