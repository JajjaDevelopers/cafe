function valuationItemCodeAndName(selectId){
    var selectedItem = document.getElementById(selectId).value;
    // var selectIndex = Number(itemSelections.indexOf(selectId));

    document.getElementById(selectId+"Code").setAttribute("value", selectedItem.slice(0,6));
    document.getElementById(selectId+"Name").setAttribute("value", selectedItem.substr(8));
}