<?php
include "connlogin.php";
include "functions.php";
if(isset($_GET['countNo'])){
    $countNo = intval($_GET['countNo']);
    $stkCountNo = formatDocNo($countNo, "STC-");
}elseif(isset($_SESSION['stockCountNo'])){
    $countNo = intval($_SESSION['stockCountNo']);
    $stkCountNo =  "STC-".$_SESSION['stockCountNo'];
}


$summSql = $conn->prepare("SELECT count_date, customer_name, deficit, excess, comment, prepared_by, prep_time, verified_by, 
                        ver_time, approved_by, appr_time, customer_id, contact_person, telephone
                        FROM stock_counting JOIN customer USING (customer_id)
                        WHERE count_no=?");
$summSql->bind_param("i", $countNo);
$summSql->execute();
$summSql->bind_result($countDate, $cltName, $deficit, $excess, $comment, $prepared_by, $prep_time, $verified_by, $ver_time,
                        $approved_by, $appr_time, $cltId, $cltContact, $cltTel);
$summSql->fetch();
$summSql->close();

$fmDate = $countDate;

//stk details


//return details
function stockCountDetails(){
    include "connlogin.php";
    global $countNo;
    $detSql = $conn->prepare("SELECT grade_id, grade_name, qty_in, qty_out, 
            (SELECT qty FROM temp_inventory WHERE inventory_reference='Stock Counting' AND document_number=1 
            AND inventory.grade_id=temp_inventory.grade_id) AS avail
            FROM inventory JOIN grades USING(grade_id)
            WHERE inventory_reference='Stock Counting' AND document_number=? ");
    $detSql->bind_param("i", $countNo);
    $detSql->execute();
    $detSql->bind_result($grdId, $grdName, $qtyIn, $qtyOut, $avail);
    ?>
    <label>Stock Counting Summary</label>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead>
        <tr style="background-color: green; color:white">
            <th style="width: 80px;">Grade Id</th>
            <th style="width: 300px;">Grade Name</th>
            <th style="width: 100px;">Available</th>
            <th style="width: 100px;">Physical Count</th>
            <th style="width: 100px;">Variance</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $ttAvailable = 0;
        $ttCount = 0;
        
        while ($detSql->fetch()){
            ?>
            <tr>
            <td><input id="<?= 'itm'.$no.'Id'?>" name="<?= 'itm'.$no.'Id'?>" value="<?=$grdId?>" class="itmNameInput" readonly></td>
            <td><?=$grdName?></td>
            <td><input type="number" id="<?= 'itm'.$no.'Available'?>" name="<?= 'itm'.$no.'Available'?>" value="<?=$avail?>" class="itmQtyInput" readonly></td>
            <td><input type="number" id="<?= 'itm'.$no.'Count'?>" name="<?= 'itm'.$no.'Count'?>" value="<?=$avail+($qtyIn-$qtyOut)?>" readonly class="itmQtyInput"
            onblur="getVariance()" ></td>
            <td><input type="number" id="<?= 'itm'.$no.'Var'?>" name="<?= 'itm'.$no.'Var'?>" value="<?=$qtyIn-$qtyOut?>" class="itmQtyInput" readonly></td>
            </tr>
            <?php
            $no +=1;
            $ttAvailable += $avail;
            $ttCount += $avail+($qtyIn-$qtyOut);
        }
        $ttVar = $ttCount-$ttAvailable;
        ?>
        <tr><strong>
            <th colspan="2">Total</th>
            <th><input type="number" id="<?= 'totalAvailable'?>" name="totalAvailable'?>" value="<?=$ttAvailable?>" class="itmQtyInput" readonly></th>
            <th><input type="number" id="<?= 'totalCount'?>" name="totalCount'?>" value="<?=$ttCount?>" class="itmQtyInput" readonly></th>
            <th><input type="number" id="<?= 'totalVar'?>" name="<?= 'totalVar'?>" value="<?=$ttVar?>" class="itmQtyInput" readonly></th>
        </tr>
        </tbody>
    </table>
    <input type="number" id="grdNo" name="grdNo" class="shortInput" value="<?=$no-1?>" readonly style="display: none;">
    <?php
}

?>