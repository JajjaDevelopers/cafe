function updateQtyss(){
    var inputVal = Number(document.getElementById("inputQty").value);
    var outputVal = Number(document.getElementById("outputQty").value);
    var husksVal = Number(document.getElementById("husksQty").value);
    document.getElementById("otherLossQty").setAttribute("value", inputVal-outputVal-husksVal);
}