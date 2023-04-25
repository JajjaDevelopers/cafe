<?php
$pageTitle = "Pending Approval";
include_once ('../forms/header.php');
$docTitles = array("Goods Received Notes (GRN)", "Batch Reports", "Release Requests", "Valuation Reports", "Hulling Report", "Drying Report",
            "Transfer Report", "Bulking Report", "Stock Adjustment", "Stock Counting", "Roastery Activities",
            "Sales Reports");
$paths = array("grnApprovalList", "batchReportList", "releaseList", "valuationList", "hullingList", "dryingList", "transferList",
                "bulkingList", "adjustmentList", "stockCountList", "activitySheetList", "salesReportList");
$docCounts = array($grnApprNum, $batchReportApprNum, $releaseApprNum, $valuationApprNum, $hullingApprNum, $dryingApprNum, $transferApprNum,
                $bulkingApprNum, $adjsutmentApprNum, $stockCountApprNum, $activitySheetApprNum, $salesReportApprNum);

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
                <?php
                $allCounts=0;
                for ($x=0;$x<count($docCounts);$x++){
                    $allCounts+=$docCounts[$x];
                    if ($docCounts[$x]!=0){
                        ?>
                        <tr>
                            <td><a href="../approval/<?=$paths[$x]?>"><?=$docTitles[$x]?></a></td>
                            <td style="text-align: center"><?= $docCounts[$x] ?></td>
                        </tr>
                        <?php
                    } 
                }
                if($allCounts==0){
                        ?>
                        <tr>
                            <td style="background-color: red; color:white">There are no pending approvals. Confirm whether all verifications are completed!</td>
                        </tr>
                        <?php
                    }
                    ?>
            </tbody>
        </table>



    </div>
</form>
<?php include("../forms/footer.php") ?>