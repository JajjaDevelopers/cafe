<?php
$pageTitle = "Transfer Approval List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Transfer Reports Pending Verification</h2>
    <?php include("../alerts/approvalAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Trans. No</th>
                    <th style="width: 100px;">Date</th>
                    <th >From</th>
                    <th >To</th>
                    <th style="width: 100px;">Total Qty (Kg)</th>
                    <th >Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php transferApprList(); ?>
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>