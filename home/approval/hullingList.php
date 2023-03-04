<?php
$pageTitle = "Hulling Verification List";
include_once ('../forms/header.php');
?>
<form class="regularForm" style="width: 800px;">
    <h2 class="formHeading">Hulling Reports Pending Verification</h2>
    <?php include("../alerts/approvalAlert.php");?>
    <div>
        <table class="table table-striped table-hover table-condensed table-bordered">
            <thead>
                <tr style="background-color: green; color: white;">
                    <th style="width: 70px;">Hulling No.</th>
                    <th style="width: 80px;">Date</th>
                    <th >Client</th>
                    <th style="width: 200px;">Input Grade</th>
                    <th style="width: 80px;">Input Qty (Kg)</th>
                    <th style="width: 200px;">Output Grade</th>
                    <th style="width: 80px;">Output Qty (Kg)</th>
                </tr>
            </thead>
            <tbody>
                <?php hullingApprList(); ?>
            </tbody>
        </table>
    </div>
</form>
<?php include("../forms/footer.php") ?>