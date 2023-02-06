<!-- referenced in connection after opening customer picker -->


</select><br>

        <label for="salesReportContact" id="salesReportBuyerLabel"  class="salesReportLabel" >Contact:</label>
        <input type="text" id="salesReportContact" name="contactPerson" readonly class="longInputField" placeholder="Contact Person" style="margin-right: 0px; width:150px">
        <label for="salesReportContact" id="salesReportBuyerLabel" name="contactPerson" class="salesReportLabel" >Tel:</label>
        <input type="text" id="salesReportTel" name="customerTel" readonly class="longInputField" placeholder="Telephone" style="margin-right: 0px; width:120px">
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

        var ajaxCustomerName = document.getElementById("name").value;
        document.getElementById("customerName").setAttribute('value', ajaxCustomerName);

        var ajaxCustomerContact = document.getElementById("contactPerson").value;
        document.getElementById("salesReportContact").setAttribute('value', ajaxCustomerContact);

        var ajaxTel = document.getElementById("tel").value;
        document.getElementById("salesReportTel").setAttribute('value', ajaxTel);
    }
    xhttp.open("GET", "../ajax/salesReportAjax.php?q="+buyer);
    xhttp.send();
    }
  </script>