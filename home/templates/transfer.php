
    <legend class="formHeading">Goods Transfer Note</legend>
    <?php
        // include "../alerts/message.php";
        
    ?>
    <div class=" mt-3 ms-5 d-flex flex-column align-items-start">
    <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
    </i>
</div>
    <div style="display: grid; width:fit-content; margin-left: 70%;">
        <label for="transfer" style="grid-column: 1; grid-row: 1; width:90px; margin-top: 5px" >Transfer No:</label>
        <input type="text" class="shortInput" id="transfer" name="transfer" value="<?= $transferNo ?>" readonly style="grid-column: 2; grid-row: 1; margin-top: 0px;">
        <label for="date" class="" style="grid-column: 1; grid-row: 2; margin-top: 10px">Date:</label>
        <input type="date" class="shortInput" id="transferDate" name="transferDate" value="<?= $tranDate ?>" style="grid-column: 2; grid-row: 2">
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
                    <input id="fromClientId" name="fromClientId" value="<?=$frmCltId?>" class="tableInput" style="display: none;" readonly>
                    <input id="fromClientName" name="fromClientName" value="<?=$frmCltName?>" class="tableInput" style="width: 250px;" readonly>
                    <select id="fromClientSelect" name="fromClientSelect" style="width: 15px;" onchange="setCustomer(this.id)" >
                        <?php GetCustomerList(); ?>
                    </select>
                </td>
                <td>
                    <input id="toClientId" name="toClientId" value="<?=$toCltId?>" class="tableInput" style="display: none;" readonly>
                    <input id="toClientName" name="toClientName" value="<?=$toCltName?>" class="tableInput" style="width: 250px;" readonly>
                    <select id="toClientSelect" name="toClientSelect" style="width: 15px;" onchange="setCustomer(this.id)">
                        <?php GetCustomerList(); ?>
                    </select>
                </td>
            </tr>
            <tr>
            <tr>
                <td>Witnessed</Section></td>
                <td>
                    <input id="fromWitnessName" name="fromWitnessName" value="<?=$fromWitness?>" class="tableInput" required>
                    
                </td>
                <td>
                    <input id="toWitnessName" name="toWitnessName" value="<?=$toWitness?>" class="tableInput" required>
                    
                </td>
            </tr>
        </tbody>
    </table>
    <?php itemsTable(5, "Transfer Items"); ?>
</div>
    <?php
    documentNotes("700px");