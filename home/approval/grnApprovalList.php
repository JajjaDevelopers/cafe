<?php
$pageTitle = "GRN Pending Approval";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">GRNs Pending Approval</h2>
    <?php include("../alerts/approvalAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color:white;">
                    <th style="width: 100px;">GRN No.</th>
                    <th style="width: 100px;">Date</th>
                    <th style="width: 250px;">Client</th>
                    <th style="width: 250px;">Grade</th>
                    <th style="width: 100px; text-align:right">Qty (Kgs)</th>
                    <th style="width: 100px;">Purpose</th>
                    <th style="width: 150px;">Captured By</th>
                </tr>
            </thead>
            <tbody>
                <?php grnApprovalList(); ?>
            </tbody>
        </table>



    </div>
</form>



<?php include("../forms/footer.php") ?>