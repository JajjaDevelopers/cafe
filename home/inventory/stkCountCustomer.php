<?php $pageTitle = "Stock Counting Customer" ?>
<?php include "../forms/header.php" ?>
<?php 
include ("../connection/databaseConn.php");
?>
<form class="regularForm" method="post" action="stockCounting.php" style="height: fit-content;">
    <h3 class="formHeading">Select Customer</h3>
    <?php
    include "../alerts/message.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <label for="clientId">Customer</label><br>
                <select id="clientId" name="clientId" class="shortInput" style="width: 300px;" required>
                    <?php clientPicker(); ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="selDate">As at Date</label><br>
                <input type="date" id="selDate" class="shortInput" name="selDate" style="width: 150px;" required>
            </div>
        </div>
    </div>
    <?php submitButton("Next", 'submit', 'btnsubmit') ?>
</form>
<?php include "../forms/footer.php" ?>