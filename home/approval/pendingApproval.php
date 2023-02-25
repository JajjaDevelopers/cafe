<?php
$pageTitle = "Pending Approval";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";

?>
<form class="regularForm">
    <h2 class="formHeading">Pending Approval</h2>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color:white;">
                    <th style="width: 500px;">Approval Item</th>
                    <th style="width: 100px; ">Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="../approval/grnApprovalList">Goods Received Notes (GRN)</a></td>
                    <td style="text-align: center"><?= $grnApprNum ?></td>
                </tr>
                <tr>
                    <td><a href="../approval/releaseList">Release Requests</a></td>
                    <td style="text-align: center"><?= $releaseApprNum ?></td>
                </tr>
                <tr>
                    <td><a href="../approval/valuationList">Valuation Reports</a></td>
                    <td style="text-align: center"><?= $valuationApprNum ?></td>
                </tr>
                <tr>
                    <td><a href="../approval/salesReportList">Sales Report</a></td>
                    <td style="text-align: center"><?= $salesReportApprNum ?></td>
                </tr>
                <tr>
                    <td><a href="../approval/hullingList">Hulling Reports</a></td>
                    <td style="text-align: center"><?= $hullingApprNum ?></td>dryingApprList
                </tr>
                <tr>
                    <td><a href="../approval/dryingList">Drying Report</a></td>
                    <td style="text-align: center"><?= $dryingApprNum ?></td>
                </tr>
                <tr>
                    <td><a href="../approval/transferList.php">Transfer Report</a></td>
                    <td style="text-align: center"><?= $transferApprNum ?></td>
                </tr>
            </tbody>
        </table>



    </div>
</form>
<?php include("../forms/footer.php") ?>