<?php
$pageTitle = "Drying Verification List";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Drying Activity Pending Verification</h2>
    <?php include("../alerts/verifyAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Dry No</th>
                    <th style="width: 100px;">Date</th>
                    <th >Client Name</th>
                    <th >Grade</th>
                    <th style="width: 100px;">Input (Kg)</th>
                    <th style="width: 70px;">MC In (%)</th>
                    <th style="width: 100px;">Output (Kg)</th>
                    <th style="width: 70px;">MC Out (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php dryingVerList(); ?>
            </tbody>
        </table>
    </div>
    <a href="../verification/pendingVerification.php" class="btn btn-primary btn-sm" role="button"><i class="bi bi-arrow-left-square-fill"></i>&nbsp;Back</a>
</form>
<?php include("../forms/footer.php") ?>