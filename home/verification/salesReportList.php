<?php
$pageTitle = "Sales Report Verification List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Sales Reports Pending Verification</h2>
    <?php include("../alerts/verifyAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Sales No.</th>
                    <th style="width: 100px;">Date</th>
                    <th>Client Name</th>
                    <th style="width: 150px;">Category</th>
                    <th style="width: 150px;">Currency</th>
                    <th style="width: 150px;">Sales Value </th>
                </tr>
            </thead>
            <tbody>
                <?php salesReportVerList(); ?>
            </tbody>
        </table>
    </div>
    <a href="../verification/pendingVerification.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<?php include("../forms/footer.php") ?>