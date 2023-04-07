<?php
$pageTitle = "Activity Verification List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Activities Pending Verification</h2>
    <?php include("../alerts/verifyAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color:white;">
                <th style="width: 100px;">Activity No</th>
                <th style="width: 100px;">Date</th>
                <th >Client Name</th>
                <th >Input Grade</th>
                <th style="width: 100px;">Input Qty (Kg)</th>
                <th style="width: 150px;">Activity Value</th>
                </tr>
            </thead>
            <tbody>
                <?php activitySheetVerList(); ?>
            </tbody>
        </table>
    </div>
    <a href="../verification/pendingVerification.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<?php include("../forms/footer.php") ?>