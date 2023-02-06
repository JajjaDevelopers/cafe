<?php
$pageTitle = "Pending Verifications";
include_once ('../forms/header.php');
// include "../private/verAndApprFunctions.php";

?>
<form class="regularForm">
    <h2 class="formHeading">Pending Verifications</h2>
    <div style="margin-top: 20px;">
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white">
                    <th style="width: 500px;">Verification Item</th>
                    <th style="width: 100px;">Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="../verification/grnVerifyList">Goods Received Notes (GRN)</a></td>
                    <td style="text-align: right;"><a href="../verification/grnVerifyList"><?= $grnVerNum ?></a></td>
                </tr>
                <tr>
                    <td><a href="../verification/releaseList">Releases</a></td>
                    <td style="text-align: right;"><a href="../verification/releaseList"><?= $releasVerNum ?></a></td>
                </tr>
                
                
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>