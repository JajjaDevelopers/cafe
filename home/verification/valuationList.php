<?php
$pageTitle = "Valuation Verification List";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Valuations Pending Verification</h2>
        <?php include("../alerts/verifyAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Valuation No.</th>
                    <th style="width: 100px;">Date</th>
                    <th >Client</th>
                    <th style="width: 150px;">Gross Value (Ugx)</th>
                    <th style="width: 150px;">Costs (Ugx)</th>
                    <th style="width: 150px;">Net Value (Ugx)</th>
                </tr>
            </thead>
            <tbody>
                <?php valuationVerList(); ?>
            </tbody>
        </table>
    </div>
    <a href="../verification/pendingVerification.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<?php include("../forms/footer.php") ?>