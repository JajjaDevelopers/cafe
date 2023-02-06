<?php $pageTitle="Transfer"; ?>
<?php include_once('../forms/header.php'); 
include ("../connection/databaseConn.php");
$transferNo = nextDocNumber('transfers', 'transfer_no', 'GTN');
?>
<form action="../connection/transfer.php" class="regularForm" method="POST" style="height: 800px;">
    <legend class="formHeading">Goods Transfer Note</legend>
    <?php
        // include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label for="transfer" style="grid-column: 1; grid-row: 1; width:90px; margin-top: 5px">Transfer No:</label>
        <input type="text" class="shortInput" id="transfer" name="transfer" value="<?= $transferNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="transferDate" name="transferDate" value="" style="grid-column: 2; grid-row: 2">
    </div>
<div>
    <label>Summary</label>
    <table>
        <?php $cellWidth="200px"?>
        <tr>
            <th>Details</th>
            <th >From</th>
            <th>To</th>
        </tr>
        <tr>
            <td>Client</td>
            <td>
                <input id="fromClientId" name="fromClientId" class="itmNameInput" style="width: <?= $cellWidth?>; display: none;" readonly>
                <input id="fromClientName" name="fromClientName" class="itmNameInput" style="width: <?= $cellWidth?>;" readonly>
                <select id="fromClientSelect" name="fromClientSelect" class="dropdown" onchange="setCustomer(this.id)" >
                    <?php GetCustomerList(); ?>
                </select>
            </td>
            <td>
                <input id="toClientId" name="toClientId" class="itmNameInput" style="width: <?= $cellWidth?>; display: none;" readonly>
                <input id="toClientName" name="toClientName" class="itmNameInput" style="width: <?= $cellWidth?>;" readonly>
                <select id="toClientSelect" name="toClientSelect" class="dropdown" onchange="setCustomer(this.id)">
                    <?php GetCustomerList(); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Warehouse Section</Section></td>
            <td>
                <!-- <input id="fromSectionName" class="itmNameInput" style="width: ;"> -->
                <select id="fromBlock" name="fromBlock" class="shortInput" onchange="getWareHouseSection(this.id)" >
                    <?php selectWarehouseBlock(); ?>
                </select>
                <select id="fromSection" name="fromSection" class="shortInput">
                    <option>Section</option>
                </select>
            </td>
            <td>
                <select id="toBlock" name="toBlock" class="shortInput" onchange="getWareHouseSection(this.id)">
                    <?php selectWarehouseBlock(); ?>
                </select>
                <select id="toSection" name="toSection" class="shortInput">
                    <option>Section</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Witnessed</Section></td>
            <td>
                <input id="fromWitnessName" name="fromWitnessName" class="itmNameInput">
                
            </td>
            <td>
                <input id="toWitnessName" name="toWitnessName" class="itmNameInput">
                
            </td>
        </tr>
    </table>
    <?php itemsTable(5, "Transfer Items"); ?>
</div>

    <?php include_once("../private/approvalDetails.php"); ?>
</form>
<?php include_once('../forms/footer.php');?>
<script src="../assets/js/itemSelector.js" ></script>
<script>
    function setCustomer(selectId){
        var selectIdList = ["fromClientSelect", "toClientSelect"];
        var nameIdList = ["fromClientName", "toClientName"];
        var clientIdList = ["fromClientId", "toClientId"];

        var selected = document.getElementById(selectId).value;
        var index = selectIdList.indexOf(selectId);
        document.getElementById(nameIdList[index]).setAttribute("value", selected.substr(7))
        document.getElementById(clientIdList[index]).setAttribute("value", selected.substr(0,6));
    }

    // //Setting item ids
    // function setItemId()


    function getWareHouseSection(blockId){
        var blockNo = document.getElementById(blockId).value;
        const xhttp = new XMLHttpRequest();
      // Changing customer namne
        xhttp.onload = function() {
        let blockList = ["fromBlock", "toBlock"];
        let sectionList = ["fromSection", "toSection"];
        var index = blockList.indexOf(blockId);

        document.getElementById(sectionList[index]).innerHTML = this.responseText;

       
      }
      xhttp.open("GET", "../ajax/getWareHouseSection.php?q="+blockNo);
      xhttp.send();
    }
    
</script>