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
    
}


// Update values when ugx px is updated
// function captureUgxPrice(){
//     //var excRate = Number(document.getElementById('exchangeRate').value);
//     for (var x=0; x < priceUgxIds.length; x++){
//         var ugPx = Number(document.getElementById(priceUgxIds[x]).value);
//         if (ugPx !=0){
//             document.getElementById(priceUsIds[x]).setAttribute('value', (ugPx / excRate));
//             var usdPx = Number(document.getElementById(priceUsIds[x]).value);
//             document.getElementById(priceCtsIds[x]).setAttribute('value', usdPx*2.20462262185);
//         }
//         captureQty();
//     }
    
// }


//Update values when Usd px is updated
// function captureUsdPrice(){
//     //var excRate = Number(document.getElementById('exchangeRate').value);
//     for (var x=0; x < priceUsIds.length; x++){
//         var usdPx = Number(document.getElementById(priceUsIds[x]).value);
//         if (usdPx !=0){
//             document.getElementById(priceCtsIds[x]).setAttribute('value', usdPx*2.20462262185);
//             document.getElementById(priceUgxIds[x]).setAttribute('value', (usdPx * excRate));
//         }
//         captureQty();
//     }
    
// }


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
// add radio button for pricing choice