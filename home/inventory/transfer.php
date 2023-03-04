<?php $pageTitle="Transfer"; ?>
<?php include_once('../forms/header.php'); 
include ("../connection/databaseConn.php");
$transferNo = nextDocNumber('transfers', 'transfer_no', 'GTN');
?>
<form action="../connection/transfer.php" class="regularForm" method="POST" style="height: fit-content; width:800px">
    <legend class="formHeading">Goods Transfer Note</legend>
    <?php
        include "../alerts/message.php";
    ?>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label for="transfer" style="grid-column: 1; grid-row: 1; width:90px; margin-top: 5px">Transfer No:</label>
        <input type="text" class="shortInput" id="transfer" name="transfer" readonly value="<?= $transferNo ?>" style="grid-column: 2; grid-row: 1; margin-top: 0px;" required>
        <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="transferDate" name="transferDate" value="<?= $today ?>" style="grid-column: 2; grid-row: 2" required>
    </div>
<div><br>
    <label>Summary</label>
    <table>
        <thead>
            <tr>
                <th style="width: 100px;">Details</th>
                <th style="width: 270px;">From</th>
                <th style="width: 270px;">To</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Client</td>
                <td>
                    <input id="fromClientId" name="fromClientId" class="tableInput" style="display: none;" readonly>
                    <input id="fromClientName" name="fromClientName" class="tableInput" style="width: 250px;" readonly required>
                    <select id="fromClientSelect" name="fromClientSelect" style="width: 15px;" onchange="setCustomer(this.id)" required>
                        <?php GetCustomerList(); ?>
                    </select>
                </td>
                <td>
                    <input id="toClientId" name="toClientId" class="tableInput" style="display: none;" readonly>
                    <input id="toClientName" name="toClientName" class="tableInput" style="width: 250px;" readonly required>
                    <select id="toClientSelect" name="toClientSelect" style="width: 15px;" onchange="setCustomer(this.id)" required>
                        <?php GetCustomerList(); ?>
                    </select>
                </td>
            </tr>
            <tr>
            <tr>
                <td>Witnessed</Section></td>
                <td>
                    <input id="fromWitnessName" name="fromWitnessName" class="tableInput" required>
                    
                </td>
                <td>
                    <input id="toWitnessName" name="toWitnessName" class="tableInput" required>
                    
                </td>
            </tr>
        </tbody>
    </table>
    <?php itemsTable(5, "Transfer Items"); ?>
</div>
    <?php
    documentNotes("700px");
    submitButton("Submit", "submit", "btnsubmit");
    ?>
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