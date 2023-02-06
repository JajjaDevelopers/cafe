<?php $pageTitle="Delivery Note"; ?>
<?php include("../forms/header.php");?>
<?php include("../private/functions.php");?>

<form class="regularForm">
    <h3 class="formHeading">Pending Dispatch</h3>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr style="background-color: green; color:white;">
                <th style="width: 100px;">Release No.</th>
                <th style="width: 100px;">Date</th>
                <th>Client</th>
                <th style="width: 250px;">Submitted By</th>
            </tr>
        </thead>
        <tbody>
            <?php pendingDispatch(); ?>
        </tbody>
    </table>
</form>


<?php include "../forms/footer.php" ?>