<?php
$pageTitle = "Marketing Transactions";
include "../forms/header.php";
//list of transaction: Name, link, description
$transactions = array( 
    array("Valuation Reports", "batchReportList", "Valuation reports made for suppliers indicating quantity and value of deliveries"),
    array("Sales Reports", "hullingList", "Sales made to customers indicating quantity and value of sales"),
    

);


?>
<form class="regularForm" style="width: 900px;">
    <h4>Sales and Marketing Transactions</h4>
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