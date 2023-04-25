    var itemCodes = [];
    var itemNames = [];
    var itemSelections = [];
    var itemQtys = [];
    var itemUsdPrices = [];
    var itemUgxPrices = [];
    var itemUsdAmounts = [];
    var itemUgxAmounts = [];

    //Adding ids to the respective lists
    for (var x=1; x<=10; x++){
        var itemId = "item"+x;
        itemCodes.push((itemId+"Code"));
        itemNames.push((itemId+"Name"));
        itemSelections.push((itemId+"Select"));
        itemQtys.push((itemId+"Qty"));
        itemUsdPrices.push((itemId+"UsdPx"));
        itemUgxPrices.push((itemId+"UgxPx"));
        itemUsdAmounts.push((itemId+"UsdAmount"));
        itemUgxAmounts.push((itemId+"UgxAmount"));
    }

    function setCodeAndName(selectId){
        var selectedItem = document.getElementById(selectId).value;
        var selectIndex = Number(itemSelections.indexOf(selectId));

        document.getElementById(itemCodes[selectIndex]).setAttribute("value", "");
        document.getElementById(itemNames[selectIndex]).setAttribute("value", "");

        document.getElementById(itemCodes[selectIndex]).setAttribute("value", selectedItem.slice(0,6));
        document.getElementById(itemNames[selectIndex]).setAttribute("value", selectedItem.substr(8));
    }

    //Autofill customer details

    function SelectCustomer(buyer){
        var selectedBuyer = document.getElementById("salesReportBuyer").value;
        document.getElementById("BuyerId").setAttribute("value", selectedBuyer.slice(0,6));
        document.getElementById("BuyerName").setAttribute("value", selectedBuyer.substr(7));

        if (buyer == "") {
            document.getElementById("BuyerId").setAttribute('value', '');
            document.getElementById("BuyerName").setAttribute('value', '');
            document.getElementById("salesReportContact").setAttribute('value','');
            document.getElementById("salesReportTel").setAttribute('value', '');
            return;
        } 

        const xhttp = new XMLHttpRequest();
        // Changing customer namne
        xhttp.onload = function() {
            document.getElementById("ajaxDiv").innerHTML = this.responseText;

            var ajaxCustomerContact = document.getElementById("contactPerson").value;
            document.getElementById("salesReportContact").setAttribute('value', ajaxCustomerContact);

            var ajaxTel = document.getElementById("tel").value;
            document.getElementById("salesReportTel").setAttribute('value', ajaxTel);
        }
        xhttp.open("GET", "../ajax/salesReportAjax.php?q="+buyer);
        xhttp.send();
    }

window.onload = function(){
    
//updating qty
    function UpdateQty(){
        var exchangeRate = Number(document.getElementById("exchangeRate").value);
        var totalQty = 0;
        var totalUsdAmounts = 0;
        var totalUgxAMounts = 0;

        for (var x=0; x<itemQtys.length; x++){
            var qty = Number(document.getElementById(itemQtys[x]).value);
            if (qty != 0){
                totalQty += qty;
                document.getElementById("totalQty").setAttribute("value", totalQty);
                var ugxPx = Number(document.getElementById(itemUgxPrices[x]).value);
                var totalUgx = qty * ugxPx;
                document.getElementById(itemUgxAmounts[x]).setAttribute("value", totalUgx);
                totalUgxAMounts += totalUgx;
                var usdPx = ugxPx/exchangeRate;
                document.getElementById(itemUsdPrices[x]).setAttribute("value", usdPx);
                var totalUsd = qty * usdPx;
                document.getElementById(itemUsdAmounts[x]).setAttribute("value", totalUsd);
                totalUsdAmounts += totalUsd;
            }
               
        }
        //set sum of amounts
        document.getElementById("ugxGrandTotal").setAttribute("value", totalUgxAMounts);
        document.getElementById("usdGrandTotal").setAttribute("value", totalUsdAmounts);
    }   

    // Enter usd price
    function UpdateUsdPx(){
        var exchangeRate = Number(document.getElementById("exchangeRate").value);
        for (var x=0; x<itemQtys.length; x++){
            var qty = Number(document.getElementById(itemQtys[x]).value);
            if (qty != 0){
                var usdPx = Number(document.getElementById(itemUsdPrices[x]).value);
                document.getElementById(itemUsdAmounts[x]).setAttribute("value", (usdPx * qty).toLocaleString);
    
                document.getElementById(itemUgxAmounts[x]).setAttribute("value", ((usdPx * qty)*exchangeRate).toLocaleString);
                document.getElementById(itemUgxPrices[x]).setAttribute("value", (usdPx *exchangeRate));
            }
            
        }
        UpdateQty();
    }

    //Enter ugx price
    function UpdateUgxPx(){
        var exchangeRate = Number(document.getElementById("exchangeRate").value);
        for (var x=0; x<itemQtys.length; x++){
            var qty = Number(document.getElementById(itemQtys[x]).value);
            if (qty != 0){
                var ugxPx = Number(document.getElementById(itemUgxPrices[x]).value);
                document.getElementById(itemUgxAmounts[x]).setAttribute("value", (ugxPx * qty).toLocaleString);
    
                document.getElementById(itemUsdAmounts[x]).setAttribute("value", ((ugxPx * qty)/exchangeRate).toLocaleString);
                document.getElementById(itemUsdPrices[x]).setAttribute("value", (ugxPx/exchangeRate));
            }
        }
        UpdateQty();
    }  

    for (var x=0; x<itemCodes.length; x++){
        document.getElementById(itemQtys[x]).addEventListener("blur", UpdateQty);
        document.getElementById(itemUgxPrices[x]).addEventListener("blur", UpdateUgxPx);
        document.getElementById(itemUsdPrices[x]).addEventListener("blur", UpdateUsdPx);
    }


    var itmSelector = document.getElementById("item1Select").value;
    // while (itmSelector == ""){
    //     document.getElementById("item1Name").setAttribute("readonly", true);
    // }

}