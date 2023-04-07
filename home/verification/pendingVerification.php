<?php
$pageTitle = "Pending Verifications";
include_once ('../forms/header.php');

$repTitles = array("Goods Received Notes (GRN)", "Releases", "Batch Reports", "Valuation", "Sales Report", "Hulling Reports", 
                    "Drying Reports", "Transfer Reports", "Bulking Reports", "Stock Adjustment", "Stock Counting", "Activity Sheets");

$repPaths = array("grnVerifyList", "releaseList", "batchReportList", "valuationList", "salesReportList", "hullingList",
                "dryingList", "transferList", "bulkingList", "adjustmentList", "stockCountList", "activitySheetList");
$repCounts = array($grnVerNum, $releasVerNum, $batchReportVerNum, $valuationVerNum, $salesReportVerNum, $hullingVerNum, $dryingVerNum, 
                $transferVerNum, $bulkingVerNum, $adjustmentVerNum, $stockCountVerNum, $activitySheetVerNum);

?>
<form class="regularForm">
    <h2 class="formHeading">Pending Verifications</h2>              
    <div style="margin-top: 20px;">
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white">
                    <th style="width: 500px;">Verification Activity</th>
                    <th style="width: 100px;">Pending</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($x=0;$x<count($repTitles);$x++){
                    if ($repCounts[$x]!=0){
                        ?>
                        <tr>
                            <td><a href="../verification/<?=$repPaths[$x]?>"><?=$repTitles[$x]?></a></td>
                            <td style="text-align: center;"><?= $repCounts[$x] ?></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>