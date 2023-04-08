 //create item ids
 var itmCodeList = [];
 var itmNameList = [];
 var itmSelectList = [];
 var itmQtyList = [];
 var itmRateList = [];
 var itmAmountList = [];
 // let responders = qtyList.concat(rateList);

 for (var x=1; x<=10; x++){ 
     itmCodeList.push("itm"+x+"Code");
     itmNameList.push("itm"+x+"Name");
     itmSelectList.push("itm"+x+"Select");
     itmQtyList.push("itm"+x+"Qty");
     itmRateList.push("itm"+x+"Rate");
     itmAmountList.push("itm"+x+"Amount");
 }

 //create service ids
 var svcCodeList = [];
 var svcNameList = [];
 var svcSelectList = [];
 var svcQtyList = [];
 var svcRateList = [];
 var svcAmountList = [];
 var svcQtyAndRateList = svcQtyList.concat(svcRateList);

 for (var x=1; x<=10; x++){ 
     svcCodeList.push("svc"+x+"Code");
     svcNameList.push("svc"+x+"Name");
     svcSelectList.push("svc"+x+"Select");
     svcQtyList.push("svc"+x+"Qty");
     svcRateList.push("svc"+x+"Rate");
     svcAmountList.push("svc"+x+"Amount");
 }

 //item selection
 function selectItemx(itmSelectId){
     
     var selectedItem = document.getElementById(itmSelectId).value;
     var selectedIndex = itmSelectList.indexOf(itmSelectId);
     var itmId = selectedItem.slice(0,6);

     document.getElementById(itmCodeList[selectedIndex]).setAttribute("value", selectedItem.slice(0,6));
     document.getElementById(itmNameList[selectedIndex]).setAttribute("value", selectedItem.substr(8));

     const xhttp = new XMLHttpRequest();
     xhttp.onload = function(){
        var grdId = this.responseText;
        document.getElementById('itm'+(selectedIndex+1)+'Unit').setAttribute("value", grdId);
     }
     xhttp.open("GET","../ajax/activitySheet.php?fun=unit&id="+itmId);
     xhttp.send();
 }

 // service selection
 function selectService(svcSelectId){
     
     var selectedItem = document.getElementById(svcSelectId).value;
     var selectedIndex = svcSelectList.indexOf(svcSelectId);

     document.getElementById(svcCodeList[selectedIndex]).setAttribute("value", selectedItem.slice(0,6));
     document.getElementById(svcNameList[selectedIndex]).setAttribute("value", selectedItem.substr(8));
 }
 
 //updating qty and price
 function updateQty(){
     var totalAmt = 0;
     for (var x=0; x<svcCodeList.length; x++){
         var qty = Number(document.getElementById(svcQtyList[x]).value);
         var rate = Number(document.getElementById(svcRateList[x]).value);
         var total = qty*rate;
         if (svcNameList[x] != "" ){
             document.getElementById(svcAmountList[x]).value = total.toLocaleString();
             totalAmt += total;
         }else{
             document.getElementById(svcQtyList[x]).value = "";
             document.getElementById(svcRateList[x]).value = "";
             document.getElementById(svcAmountList[x]).value = "";
         }
     }
     document.getElementById("totalAmount").value = totalAmt.toLocaleString();
 }


 //Toggling between tables
 var nextBtn = document.getElementById("nextButton");
 var nextTbl = document.getElementById("inventoryTable");
 var prevTbl = document.getElementById("servicesTable");
 var sbmtBtn = document.getElementById("submitButton");
 var prevBtn = document.getElementById("previousButton");

 function switchToInventory(){
     nextBtn.style.display = "none";
     prevTbl.style.display = "none";
     nextTbl.style.display = "block";
     sbmtBtn.style.display = "block";
     prevBtn.style.display = "block";
 }

 //previous table display
 
 function switchToServices(){
     nextBtn.style.display = "block";
     prevTbl.style.display = "block";
     nextTbl.style.display = "none";
     sbmtBtn.style.display = "none";
     prevBtn.style.display = "none";
 }


 document.getElementById("nextButton").addEventListener("click", switchToInventory);
 document.getElementById("previousButton").addEventListener("click", switchToServices);