<?php $pageTitle="Petty Cash Request"; ?>
<?php require ("header.php") ?>
<?php include ("../connection/databaseConn.php");
$prfNo = nextDocNumber("petty_cash", "sn", "PRF"); 
$requestor = $_SESSION["fullName"];
?>
<form id="pettyCash" name="pettyCash" class="regularForm" style="height:auto;" method="POST" action="../connection/pettycash.php">
    <h3 class="formHeading">Payment Acknowledgement</h3>
    <div style="margin-left: 80%;">
        <label>Sn:</label>
        <input id="snInput" name="snInput" class="shortInput" readonly value="<?= $prfNo ?>">
    </div>
    <label for="amount">This is to request for funds amounting to:</label><br>
    <input type="number" id="amount" name="amount" class="shortInput" value="" placeholder="Amount" style="text-align: left;"><br><br>
    <label for="reason">Being payment for</label><br>
    <input type="text" id="reason" name="reason" class="dottedInput" value="" style="text-align: left;"><br>
    
    <label>Requested By:</label><br>
    <label for="requestedBy" style="margin-right: 20px;">Name:</label>
    <input type="text" id="requestedBy" class="dottedInput" value="<?= $requestor ?>" style="text-align: left;"><br>
    <label for="requestedBy" style="margin-right: 20px;">Date:</label>
    <input type="text" id="requestedBy" class="dottedInput" value="<?= date("d-M-Y") ?>" style="text-align: left;"><br>














<?php include "submitButton.php" ?>
</form>
<?php require ("footer.php") ?>