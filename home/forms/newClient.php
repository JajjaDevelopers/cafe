<?php
$pageTitle = "New Client";
include_once ('header.php');
?>

<form class="regularForm" method="POST" action="../connection/newClient.php" style="width:900px">
    <h3 class="formHeading" >New Client</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <label >Customer ID</label><br>
                <input type="text" id="newClientId" name="newClientId" class="shortInput" readonly maxlength="6">
            </div>
            <div class="col-md-10">
                <label for="customerName">Customer Name:</label><br>
                <input type="text" id="customerName" name="customerName" class="shortInput" maxlength="200" 
                style="width: 400px;" onkeyup="createId(this.id)">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
                <label for="category">Client Type</label><br>
                <select type="text" id="category" name="category" class="longInputField">
                    <option value="INDIVIDUAL">INDIVIDUAL</option>
                    <option value="ASSOCIATION">ASSOCIATION</option>
                    <option value="COOPERATIVE">COOPERATIVE</option>
                    <option value="COMPANY">COMPANY</option>
                </select>
            </div>
            <div class="col-sm-4" >
                <label for="membership">Membership</label><br>
                <select type="text" id="membership" name="membership" class="longInputField">
                    <option value="1">Nucafe Member</option>
                    <option value="0">Third Party</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="business">Business</label><br>
                <select type="text" id="business" name="business" class="longInputField" required>
                    <option></option>
                    <option value="Supplier">Supplier</option>
                    <option value="Buyer">Buyer</option>
                    <option value="Both">Both</option>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
                <label for="contactPerson">Contact Person</label><br>
                <input type="text" id="contactPerson" name="contactPerson" class="longInputField">
            </div>
            <div class="col-sm-4">
                <label for="telephone">Contact Telephone</label><br>
                <input type="number" id="telephone" name="telephone" class="longInputField">
            </div>
            <div class="col-sm-4">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" class="longInputField"><br>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
                <label for="region">Continent</label><br>
                <select type="text" id="continent" name="continent" class="longInputField" onchange="getCountry()">
                    <option value="Africa">Africa</option>
                    <option value="Europe">Europe</option>
                    <option value="North America">North America</option>
                    <option value="Asia">Asia</option>
                    <option value="South America">South America</option>
                    <option value="South America">Australia</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="country">Country</label><br>
                <select type="text" id="country" name="country" class="longInputField">
                </select>
            </div>
            <div class="col-sm-4">
                <label for="city">City</label><br>
                <input type="text" id="city" name="city" class="longInputField">
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
                <label for="region">Region</label><br>
                <select type="text" id="region" name="region" class="longInputField" onchange="getRegionDistricts(this.id)">
                    <option>Region</option>
                    <option value="EAST">EAST</option>
                    <option value="CENTRAL">CENTRAL</option>
                    <option value="NORTH">NORTH</option>
                    <option value="WEST">WEST</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="district">District</label><br>
                <select type="text" id="district" name="district" class="longInputField">
                </select>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>

    
    
    
    <?php include "submitButton.php" ?>
</form>
<?php include_once ('footer.php'); ?>
<script>
    function createId(nameInputId){
        var nameInput = document.getElementById("customerName").value;
        var characters = "";
        for (var x=0; x<nameInput.length; x++){
            var c = nameInput[x];
            if (c != " "){
                characters += c;
                if (characters.length < 3){
                    document.getElementById("newClientId").setAttribute("value", nameInput.toUpperCase());
                }else if (characters.length == 3){
                    var idCode =  document.getElementById("newClientId").value;
                    const idRequest = new XMLHttpRequest();
                    idRequest.onload = function(){
                        document.getElementById("newClientId").setAttribute("value", this.responseText);
                    }
                    idRequest.open("GET", "../ajax/clientIdAjax.php?q="+characters.toUpperCase());
                    idRequest.send();
                }
            }
        }
        if (characters.length == 0){
            document.getElementById("newClientId").setAttribute("value", "");
        }
    }
</script>
<script src="../assets/js/locations.js"></script>

