<?php
$pageTitle = "Inventory Transactions";
include "../forms/header.php";
//list of transaction: Name, link, description
$transactions = array( 
    array("Coffee Received", "grnList", "Stock transfer between clients and changing item ownership"),
    array("Item Transfer", "transferList", "Stock transfer between clients and changing item ownership"),
    array("Coffee Bulking", "bulkingList", "Bulking different grades to recognise as one grade"),
    array("Stock Adjustment", "adjsutmentList", "Adjusted item quantities to reconcile physical stock balances"),
    array("Stock Counting", "stockCountList", "Periodical stock counting made"),
    array("Coffee Released", "releaseList", "Periodical stock counting made"),




);


?>
<form class="regularForm" style="width: 900px;">
    <h4>Inventory Transactions</h4>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
            <tr style="background-color: green; color:white;">
                <th style="width: 300px;"><h6>Transactions</h6></th>
                <th><h6>Description</h6></th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($row=0;$row<count($transactions);$row++){
                ?>
                <tr>
                    <td>
                        <h6><a href="../transactions/<?=$transactions[$row][1]?>"><?=$transactions[$row][0]?></a></h6>
                    </td>
                    <td>
                        <p><?=$transactions[$row][2]?></p>
                    </td>
                </tr>
                <?php
            }
            ?>
            
        </tbody>
    </table>
</form>
<?php
include "../forms/footer.php";
?>