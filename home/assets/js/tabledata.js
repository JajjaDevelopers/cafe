var bodyR=document.getElementById("tableReceived").getElementsByTagName("tbody")[0];
var bodyRrow1=bodyR.getElementsByTagName("tr")[0];//first row
var bodyRrow1Cell1=bodyRrow1.getElementsByTagName("td")[0];
var bodyRrow1Cell2=bodyRrow1.getElementsByTagName("td")[1];
var bodyRrow2=bodyR.getElementsByTagName("tr")[1];//second row
var bodyRrow2Cell1=bodyRrow2.getElementsByTagName("td")[0];
var bodyRrow2Cell2=bodyRrow2.getElementsByTagName("td")[1];
// console.log(bodyRrow2Cell2);

//getting table elements for monthly coffee moved out
var bodyM=document.getElementById("tableMovedOut").getElementsByTagName("tbody")[0];
var bodyMrow1=bodyM.getElementsByTagName("tr")[0];//first row
var bodyMrow1Cell1=bodyMrow1.getElementsByTagName("td")[0];
var bodyMrow1Cell2=bodyMrow1.getElementsByTagName("td")[1];
var bodyMrow2=bodyM.getElementsByTagName("tr")[1];//second row
var bodyMrow2Cell1=bodyMrow2.getElementsByTagName("td")[0];
var bodyMrow2Cell2=bodyMrow2.getElementsByTagName("td")[1];

//getting table elements for monthly variance
var bodyV=document.getElementById("monthlyVariance").getElementsByTagName("tbody")[0];
var bodyVrow2=bodyV.getElementsByTagName("tr")[1];//second row
var bodyVrow2Cell1=bodyVrow2.getElementsByTagName("td")[0];
var bodyVrow2Cell2=bodyVrow2.getElementsByTagName("td")[1];

//getting table elements for quarterly coffee received
var bodyQ=document.getElementById("tableQReceived").getElementsByTagName("tbody")[0];
var bodyQrow1=bodyQ.getElementsByTagName("tr")[0];//first row
var bodyQrow1Cell1=bodyQrow1.getElementsByTagName("td")[0];
var bodyQrow1Cell2=bodyQrow1.getElementsByTagName("td")[1];
var bodyQrow2=bodyQ.getElementsByTagName("tr")[1];//second row
var bodyQrow2Cell1=bodyQrow2.getElementsByTagName("td")[0];
var bodyQrow2Cell2=bodyQrow2.getElementsByTagName("td")[1];

//getting table elements for quarterly coffee moved out
var bodyQM=document.getElementById("tableQMovedOut").getElementsByTagName("tbody")[0];
var bodyQMrow1=bodyQM.getElementsByTagName("tr")[0];//first row
var bodyQMrow1Cell1=bodyQMrow1.getElementsByTagName("td")[0];
var bodyQMrow1Cell2=bodyQMrow1.getElementsByTagName("td")[1];
var bodyQMrow2=bodyQM.getElementsByTagName("tr")[1];//second row
var bodyQMrow2Cell1=bodyQMrow2.getElementsByTagName("td")[0];
var bodyQMrow2Cell2=bodyQMrow2.getElementsByTagName("td")[1];

//getting table elemnts for quarterly variance
var bodyQV=document.getElementById("quarterlyVariance").getElementsByTagName("tbody")[0];
var bodyQVrow2=bodyQV.getElementsByTagName("tr")[1];//second row
var bodyQVrow2Cell1=bodyQVrow2.getElementsByTagName("td")[0];
var bodyQVrow2Cell2=bodyQVrow2.getElementsByTagName("td")[1];

//picking monthly movement data;
function monthlyMovementData()
{
  var request2= new XMLHttpRequest();
  request2.open("GET","monthlyMovement.php");
  request2.onload=function(){
    if(this.status ==200)
    {
      var ourData=JSON.parse(this.responseText);
      for(i in ourData)
      {
        var months=ourData[0];
        var quantityReceived=ourData[1];
        var quantityMovedOut=ourData[2];
        var quantityVariance=ourData[3];
      }

      coffeeReceived(months,quantityReceived);
      coffeeMovedOut(months,quantityMovedOut);
      monthlyVariance(quantityVariance,quantityReceived,quantityMovedOut);
      console.log(ourData);
    }

  }
  request2.send();

  //function for coffee received
  function coffeeReceived(receivedMonths,receivedQuantity)
  {

    bodyRrow1Cell1.innerText=receivedMonths[0];
    bodyRrow1Cell2.innerText=receivedMonths[1];
    bodyRrow2Cell1.innerText=receivedQuantity[0];
    bodyRrow2Cell2.innerText=receivedQuantity[1];
  }

  //function for coffee moved out
  function coffeeMovedOut(movedOutMonths,movedOutQuantity)
  {
    bodyMrow1Cell1.innerText=movedOutMonths[0];
    bodyMrow1Cell2.innerText=movedOutMonths[1];
    bodyMrow2Cell1.innerText=movedOutQuantity[0];
    bodyMrow2Cell2.innerText=movedOutQuantity[1];
    // console.log(movedOutQuantity)
  }

  //function for variance
  function monthlyVariance(varianceQuantity,receivedQuantity,movedOutQuantity)
  {
    var receivedVariance;
    var movedOutVariance;

    if(receivedQuantity[1]===0)
    {
      receivedVariance=100;
    }else{
      receivedVariance=(((varianceQuantity[0]/receivedQuantity[1])*100)).toFixed(1);
    }


    if(movedOutQuantity[1]===0)
    {
      movedOutVariance=100;
    }else{
      movedOutVariance=((varianceQuantity[1]/movedOutQuantity[1])*100).toFixed(1);
    }

    bodyVrow2Cell1.innerText=receivedVariance;
    bodyVrow2Cell2.innerText=movedOutVariance;
    
  }

}

monthlyMovementData();

//function to handle quarterly movement
function quarterlyMovementData()
{
   //picking quarterly movement data;
var request3= new XMLHttpRequest();
request3.open("GET","quarterlyMovement.php");
request3.onload=function(){
  if(this.status ==200)
  {
    var ourData=JSON.parse(this.responseText);
    for(i in ourData)
      {
        var quarters=ourData[0];
        var quantityReceived=ourData[1];
        var quantityMovedOut=ourData[2];
        var quantityVariance=ourData[3];
      }

      coffeeReceived(quarters,quantityReceived);
      coffeeMovedOut(quarters,quantityMovedOut);
      quarterlyVariance(quantityVariance,quantityReceived,quantityMovedOut);
      console.log(ourData);
    
  }

}
request3.send();

//function for quarterly coffee received
function coffeeReceived(receivedQuarters,receivedQuantity)
  {

    bodyQrow1Cell1.innerText=receivedQuarters[0];
    bodyQrow1Cell2.innerText=receivedQuarters[1];
    bodyQrow2Cell1.innerText=receivedQuantity[0];
    bodyQrow2Cell2.innerText=receivedQuantity[1];
  }

  //function for coffee moved out
  function coffeeMovedOut(movedOutQuarters,movedOutQuantity)
  {
    bodyQMrow1Cell1.innerText=movedOutQuarters[0];
    bodyQMrow1Cell2.innerText=movedOutQuarters[1];
    bodyQMrow2Cell1.innerText=movedOutQuantity[0];
    bodyQMrow2Cell2.innerText=movedOutQuantity[1];
    // console.log(movedOutQuantity)
  }

  //function for variance
  function quarterlyVariance(varianceQuantity,receivedQuantity,movedOutQuantity)
  {
    var receivedVariance;
    var movedOutVariance;
    
    if(receivedQuantity[1]===0)
    {
      receivedVariance=100;
    }else{
      receivedVariance=(((varianceQuantity[0]/receivedQuantity[1])*100)).toFixed(1);
    }

    if(movedOutQuantity[1]===0)
    {
      movedOutVariance=100;
    }else{
      movedOutVariance=((varianceQuantity[1]/movedOutQuantity[1])*100).toFixed(1);
    }

    bodyQVrow2Cell1.innerText=receivedVariance+"%";
    bodyQVrow2Cell2.innerText=movedOutVariance+"%";
    console.log(receivedVariance);
  }

}

quarterlyMovementData()