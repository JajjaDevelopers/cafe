<?php
$pageTitle = "Stock Adjustment Verification List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 1000px;">
    <h2 class="formHeading">Stock Adjustment Pending Verification</h2>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color:white;">
                    <th style="width: 100px;">Adjust. No</th>
                    <th style="width: 100px;">Date</th>
                    <th >Client Name</th>
                    <th style="width: 100px;">Affected</th>
                    <th style="width: 100px;">Added (Kg)</th>
                    <th style="width: 100px;">Reduced (Kg)</th>
                    <th >Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php adjustmentVerList(); ?>
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>