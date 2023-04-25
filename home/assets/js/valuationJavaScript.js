// var codeIds = ['', 'highGrade2Code', 'highGrade3Code', 'highGrade4Code', 'highGrade5Code'];
var codeIds = [];
var nameIds = [];
var yieldIds = [];
var qtyIds = [];
var priceUsIds = [];
var priceCtsIds = [];
var priceUgxIds = [];
var amountUsIds = [];
var amountUgxIds = [];
var itemSelections = [];
for (var x=1; x<=10; x++){
    codeIds.push("highGrade"+x+"Code");
    nameIds.push("highGrade"+x+"Name");
    yieldIds.push("highGrade"+x+"Yield");
    qtyIds.push("highGrade"+x+"Qty");
    priceUsIds.push("highGrade"+x+"PriceUs");
    priceCtsIds.push("highGrade"+x+"PriceCts");
    priceUgxIds.push("highGrade"+x+"PriceUgx");
    amountUsIds.push("highGrade"+x+"AmountUs");
    amountUgxIds.push("highGrade"+x+"AmountUgx");
    itemSelections.push("highGrade"+x+"Select");
    
}
var totalYieldQty = Number(document.getElementById("totalQty").value);
if (totalYieldQty<=0){
    document.getElementById("verifyBtn").disabled = true;
}


// Getting grade list
function valuationItemCodeAndName(selectId){
    var selectedItem = document.getElementById(selectId).value;
    var selectIndex = Number(itemSelections.indexOf(selectId));

    document.getElementById(codeIds[selectIndex]).setAttribute("value", selectedItem.slice(0,6));
    document.getElementById(nameIds[selectIndex]).setAttribute("value", selectedItem.substr(8));
}


function getListTotal(listName, totalId){ 
    
    var grandTotal = 0;
    for (var i=0; i<listName.length; i++){
        var itemQty = Number(document.getElementById(listName[i]).value);
        grandTotal += itemQty;
    }
    document.getElementById(totalId).setAttribute('value', grandTotal);

    captureCosts();

    
}

function captureQty(){
    var excRate = Number(document.getElementById('exchangeRate').value);
    var faqQty = Number(document.getElementById('FAQQty').value);
    for (var x=0; x < qtyIds.length; x++){
        var qty = Number(document.getElementById(qtyIds[x]).value);
        var ugxRate = Number(document.getElementById(priceUgxIds[x]).value);
        var usRate = Number(document.getElementById(priceUsIds[x]).value);
        if (qty > 0){
            // Set yield, US amount and Ugx amount
            document.getElementById(yieldIds[x]).setAttribute('value', (qty/faqQty)*100);
            document.getElementById(priceUsIds[x]).setAttribute('value', (ugxRate / excRate));
            document.getElementById(priceCtsIds[x]).setAttribute('value', (ugxRate / excRate)*2.20462262185);
            document.getElementById(amountUsIds[x]).setAttribute('value', (qty*(ugxRate / excRate))); 
            document.getElementById(amountUgxIds[x]).setAttribute('value', (qty*ugxRate)); 

        }
    }
    getListTotal(yieldIds, 'totalYield');
    getListTotal(qtyIds, 'totalQty');
    getListTotal(amountUsIds, 'grandTotaltUs');
    getListTotal(amountUgxIds, 'grandTotaltUgx');
    var totalYieldQty = Number(document.getElementById("totalQty").value);
    var baseQty = Number(document.getElementById("FAQQty").value);
    if (totalYieldQty>baseQty){
        document.getElementById("qtyCheck").style.display="block";
        document.getElementById("verifyBtn").disabled = true;
    }else if (totalYieldQty<=0){
        document.getElementById("verifyBtn").disabled = false;
        document.getElementById("verifyBtn").disabled = true;
    }
    else {
        document.getElementById("qtyCheck").style.display="none";
        document.getElementById("verifyBtn").disabled = false;
    }
    
}

for (var x=0; x < qtyIds.length; x++){
    document.getElementById(qtyIds[x]).addEventListener("blur", captureQty);
    document.getElementById(priceUgxIds[x]).addEventListener("blur", captureQty);
}


function captureCosts(){
    var excRate = Number(document.getElementById('exchangeRate').value);
    var ugxCosts = Number(document.getElementById('totalCostsUgx').value);
    if (ugxCosts>0){
        document.getElementById('totalCostsUsd').setAttribute('value', ugxCosts/excRate);
        document.getElementById('subTotalCostsUsd').setAttribute('value', ugxCosts/excRate);
        document.getElementById('subTotalCostsUgx').setAttribute('value', ugxCosts);
    }
    

    var grandTotaltValue = document.getElementById('grandTotaltUgx').value;
    var subTotalCosts = document.getElementById('subTotalCostsUgx').value;
    document.getElementById('totalValueUgx').setAttribute('value', grandTotaltValue - subTotalCosts);
    document.getElementById('totalValueUsd').setAttribute('value', (grandTotaltValue - subTotalCosts)/excRate);
}
document.getElementById('totalCostsUgx').addEventListener("blur", captureCosts);


function updateOrder(str){
    var selectedClient = document.getElementById('valuationClient').value;
    var batchNo = selectedClient.slice(0,5);
    var batchOrderNumber =  document.getElementById('batchNo')
    var x = Number(batchNo);
    batchOrderNumber.setAttribute('value', (batchNo));
    if (str == "") {
        document.getElementById("customerId").setAttribute('value', '');
        document.getElementById("valuationSupplier").setAttribute('value', '');
        return;
    } 
    const xhttp = new XMLHttpRequest();
    // Changing customer namne
    xhttp.onload = function() {
        document.getElementById("ajaxDiv").innerHTML = this.responseText;

        var ajaxCustomerId = document.getElementById("cid").value;
        document.getElementById("customerId").setAttribute('value', ajaxCustomerId);

        var ajaxCustomerName = document.getElementById("name").value;
        document.getElementById("valuationSupplier").setAttribute('value', ajaxCustomerName);

        var ajaxInputContactPerson = document.getElementById("contactPerson").value;
        document.getElementById("valuationContactPerson").setAttribute('value', ajaxInputContactPerson);

        var ajaxTel = document.getElementById("tel").value;
        document.getElementById("valuationTelephone").setAttribute('value', ajaxTel);
        

        var ajaxGrnNo= document.getElementById("grnNo").value;
        document.getElementById("valuationGrnNumber").setAttribute('value', ajaxGrnNo);

        // var ajaxInputGrade = document.getElementById("gradeName").value;
        // document.getElementById("FAQQty").setAttribute('value', ajaxInputGrade);

        var ajaxInputQty = document.getElementById("inputQty").value;
        document.getElementById("FAQQty").setAttribute('value', ajaxInputQty);

    }
    xhttp.open("GET", "../ajax/valuationAjax.php?q="+str);
    xhttp.send();
}

//fx
function getFx(str){
    const xhttp = new XMLHttpRequest();
    // 
    
    xhttp.onload = function() {
        document.getElementById("exchangeRate").setAttribute("value", this.responseText);

    }
    xhttp.open("GET", "../ajax/forex.php?selDate="+str);
    xhttp.send();
}