<?php
$pageTitle = "Roastery Transactions";
include "../forms/header.php";
//list of transaction: Name, link, description
$transactions = array( 
    array("Activity Sheets", "activitySheetList", "Roastery activities done for clients")
    

);


?>
<form class="regularForm" style="width: 900px;">
    <h4>Roastery Transactions</h4>
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