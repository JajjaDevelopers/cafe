document.getElementById("salesReportBuyer").addEventListener("change", getReferences);
//update summary
function contractSummary(){
    var contNum = document.getElementById("reference").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        var contSummary =  JSON.parse(this.responseText);
        document.getElementById("country").setAttribute('value', contSummary[0]);
        document.getElementById("contNo").setAttribute('value', contNum);
        document.getElementById("shipdDate").setAttribute('value', contSummary[1]);
        document.getElementById("incoterms").setAttribute('value', contSummary[2]);
        document.getElementById("currency").setAttribute('value', contSummary[5]);
        var reqQty = Number(contSummary[3]);
        var allocQty = Number(contSummary[4]);
        
        var fulfillRate = (allocQty*100/reqQty).toLocaleString() ;
        if (allocQty=="0"){
            fulfillRate=0;
        }
        document.getElementById("fulfilled").setAttribute('value', allocQty+'Kg ('+fulfillRate+'%)');
        getItems();

        document.getElementById('ReqQty').setAttribute("value", reqQty);
        document.getElementById('AllocQty').setAttribute("value", allocQty);
        document.getElementById('BalQty').setAttribute("value", reqQty-allocQty);
        
    }
    xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getSummary");
    xhttp.send();

}

function getReferences(){
    //var contReference = document.getElementById('reference').value;
    var contClient = document.getElementById("customerId").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById("reference").innerHTML=this.responseText;
    }
    xhttp.open("GET", "../ajax/contractManager.php?clt="+contClient+"&q=getReference");
    xhttp.send();

}

//get contract items
function getItems(){
    var contNum = document.getElementById("reference").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        for (var x=1;x<=10;x++){
            document.getElementById("item"+x+"Select").innerHTML=this.responseText;
        }
        
    }
    xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getItems");
    xhttp.send();

}

function pickItem(x){
    var contNum = document.getElementById("reference").value;
    var selectedItem = document.getElementById('item'+x+'Select').value;
    var id=selectedItem.slice(0,6);
    document.getElementById('item'+x+'Code').setAttribute("value", id);
    document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(6));
    
    const xhttp = new XMLHttpRequest();
    
    xhttp.onload = function(){
        var qtyValues = JSON.parse(this.responseText);
        document.getElementById("item"+x+"ReqQty").setAttribute("value", qtyValues[0]);
        document.getElementById("item"+x+"AllocQty").setAttribute("value", qtyValues[1]);
        document.getElementById("item"+x+"BalQty").setAttribute("value", qtyValues[2]);
        getValuations(x);

    }
    xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getQtys&grd="+id);
    xhttp.send();
}

//get valuations available
function getValuations(x){
    // var allocQty = Number(document.getElementById('item'+x+'AllocQty').value);
    var contNum = document.getElementById("reference").value;
    var selectedItem = document.getElementById('item'+x+'Select').value;
    var id=selectedItem.slice(0,6);
    document.getElementById('item'+x+'Code').setAttribute("value", id);
    document.getElementById('item'+x+'Name').setAttribute("value", selectedItem.slice(6));
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById("item"+x+"Src").innerHTML=this.responseText;
        calTotals();
    }
    xhttp.open("GET", "../ajax/contractManager.php?no="+contNum+"&q=getVal&grd="+id);
    xhttp.send();
}

//get valuation qtys
function valuationQty(x){
    var valNo = Number(document.getElementById('item'+x+'Src').value);
    var selectedItem = document.getElementById('item'+x+'Select').value;
    var id=selectedItem.slice(0,6);

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById("item"+x+"SrcQty").setAttribute("value", this.responseText);

        calTotals();
    }
    xhttp.open("GET", "../ajax/contractManager.php?no="+valNo+"&q=getValQty&grd="+id);
    xhttp.send();
    
}

//get all totals
function calTotals(){
    var totalReqQty = 0;
    var totalAllocQty = 0;
    var totalBalQty = 0;
    var totalSrcQty = 0;
    var totalDistQty = 0;
    var ids = ["SrcQty", "DistQty"];
    var totalVars = [totalSrcQty, totalDistQty];

    for (var i=0;i<ids.length;i++){
        for (var x=1;x<=10;x++){
            var qty = document.getElementById("item"+x+ids[i]).value;
            totalVars[i] += Number(qty);
        }
        document.getElementById(ids[i]).setAttribute("value", totalVars[i]);
    }
}

