<div id="ajaxDiv" style="display: none;"> </div>
<div id="customerDetailsDiv" style="margin-top: 50px;">
    <label for="salesReportBuyer" id="salesReportBuyerLabel" class="salesReportLabel" >Client:</label>
    <input type="text" id="customerId" name="customerId" value="" readonly class="longInputField" placeholder="ID" style="width: 70px; margin-right: 0px;">
    <input type="text" id="customerName" name="customerName" value="" readonly class="longInputField" placeholder="Customer Name" style="margin-left: 0px; margin-right: 0px; width: 280px">
    <select id="salesReportBuyer" class="longInputField" name="salesReportBuyer" style="margin-left: 0px; width: 20px"
    onchange="SelectCustomer(this.value)">
        <?php GetCustomerList(); ?>
    </select><br>

    <label for="salesReportContact">Contact:</label>
    <input type="text" id="salesReportContact" value="" readonly class="longInputField" placeholder="Contact Person" style="margin-right: 0px; width:150px">
    <label for="salesReportContact" style="margin-left: 39px;">Tel:</label>
    <input type="text" id="salesReportTel" value="" readonly class="longInputField" placeholder="Telephone" style="margin-right: 0px; width:120px">
</div>
<script>
    function SelectCustomer(buyer){
    var selectedBuyer = document.getElementById("salesReportBuyer").value;
    document.getElementById("customerId").setAttribute("value", selectedBuyer.slice(0,6));
    document.getElementById("customerName").setAttribute("value", selectedBuyer.substr(7));

    if (buyer == "") {
        document.getElementById("customerId").setAttribute('value', '');
        document.getElementById("customerName").setAttribute('value', '');
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
</script>
