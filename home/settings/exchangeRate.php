<?php
$pageTitle="Exchange Rates";

?>
<?php include "../forms/header.php" ?>
<?php include ("../connection/databaseConn.php");?>
<form method="post" action="../connection/exchangeRate.php" class="regularForm" style="height: fit-content;">
    <h3 class="formHeading">Daily Exchange Rate</h3>
    <div class="container" style="border: solid 1px green; border-radius: 10px">
        <div class="row">
            <div class="col-md-12" style="margin: 20px 0px 30px;">
                <label for="date">Date</label><br>
                <input type="date" id="date" name="date" value="<?=$fmDate ?>" class="shortInput" style="width: 150px;" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="currency">Currency</label><br>
                <select id="currency" name="currency" class="shortInput" style="width: 150px;" required>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="rate">Rate</label><br>
                <input type="number" id="rate" name="rate" class="shortInput" step="0.01" style="width: 150px; text-align:right" required>
            </div>
            <div class="col-md-6" style="margin-bottom: 20px">
                <label for="ref">Reference</label><br>
                <input type="text" id="ref" name="ref" class="shortInput" style="width: 350px;">
            </div>
        </div>
    </div>
    <?php submitButton("Submit", "submit", "confirm") ?>
    <div>
        <?php previousFx(); ?>
    </div>

</form>
<?php include "../forms/footer.php" ?>