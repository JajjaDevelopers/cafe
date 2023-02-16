<?php
$pageTitle="General Sample List";
include "../connection/databaseConn.php";
?>
<?php include_once('../forms/header.php'); ?>
<form class="regularForm" style="width:1000px">
    <h3 class="formHeading">General Sample List</h3>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr style="background-color: green; color:white">
                <th style="width:70px">GRN No.</th>
                <th style="width:100px">Delivery Date</th>
                <th>Client</th>
                <th>Grade</th>
                <th style="width:100px">Weight (Kg)</th>
                <th style="width:100px">Moisture (%)</th>
                <th style="width:200px">Pre-sample Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php generalSampleList() ?>
        </tbody>
    </table>

</form>
<?php include_once('../forms/footer.php'); ?>