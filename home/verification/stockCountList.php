<?php
$pageTitle = "Stock Counting Verification List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Stock Counting Pending Verification</h2>
    <?php include("../alerts/verifyAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Count. No</th>
                    <th style="width: 100px;">Date</th>
                    <th >Client Name</th>
                    <th style="width: 100px;">Total Deficit (Kg)</th>
                    <th style="width: 100px;">Total Excess (Kg)</th>
                    <th style="width: 100px;">Net Qty (Kg)</th>
                    <th >Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php stockCountVerList(); ?>
            </tbody>
        </table>
    </div>
    <a href="../verification/pendingVerification.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<?php include("../forms/footer.php") ?>