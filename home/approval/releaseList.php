<?php
$pageTitle = "GRN Pending Verifications";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Release Pending Approval</h2>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 100px;">Release No.</th>
                    <th style="width: 100px;">Date</th>
                    <th >Client</th>
                    <th style="width: 120px;">Total Qty (Kgs)</th>
                    <th style="width: 150px;">Destination</th>
                    <th style="width: 150px;">Initiated By</th>
                </tr>
            </thead>
            <tbody>
                <?php releaseApprList(); ?>
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>