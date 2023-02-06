<?php
include ("../private/connlogin.php");
if($mysqli->connect_error) {
  exit('Could not connect');
}
?>
<?php
$client = $_POST['clientId'];
$selDate = $_POST['selDate'];

//get customer details
$custSql = $conn->prepare("SELECT customer_name, contact_person, telephone FROM customer WHERE customer_id=?");
$custSql->bind_param("s", $client);
$custSql->execute();
$custSql->bind_result($cltName, $cltContact, $cltTel);
$custSql->fetch();
$custSql->close();


//stock counting returns
$sql = $conn->prepare("SELECT grade_id, sum(qty_in)-sum(qty_out) AS bal, grade_name FROM inventory
                        JOIN grades  USING (grade_id) WHERE (customer_id=? AND trans_date<=?)
                        GROUP BY grade_id ORDER BY coffee_type, type_category, grade_name");
$sql->bind_param("ss", $client, $selDate);
$sql->execute();
$sql->bind_result($id, $avail, $name);
?><br>
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
    while ($sql->fetch()){
        ?>
        <tr>
        <td><input id="<?= 'itm'.$no.'Id'?>" name="<?= 'itm'.$no.'Id'?>" value="<?=$id?>" class="itmNameInput" readonly></td>
        <td><?=$name?></td>
        <td><input type="number" id="<?= 'itm'.$no.'Available'?>" name="<?= 'itm'.$no.'Available'?>" value="<?=$avail?>" class="tableInput" readonly></td>
        <td><input type="number" id="<?= 'itm'.$no.'Count'?>" name="<?= 'itm'.$no.'Count'?>" value="" class="tableInput"
        onblur="getVariance()"></td>
        <td><input type="number" id="<?= 'itm'.$no.'Var'?>" name="<?= 'itm'.$no.'Var'?>" value="0" class="tableInput" readonly></td>
        </tr>
        <?php
        $no +=1;
    }
    ?>
    <tr>
        <th colspan="2">Total</th>
        <th><input type="number" id="<?= 'totalAvailable'?>" name="totalAvailable'?>" value="" class="tableInput" readonly></th>
        <th><input type="number" id="<?= 'totalCount'?>" name="totalCount'?>" value="" class="tableInput" readonly></th>
        <th><input type="number" id="<?= 'totalVar'?>" name="<?= 'totalVar'?>" value="" class="tableInput" readonly></th>
    </tr>
    </tbody>
</table>
<input type="number" id="grdNo" name="grdNo" class="shortInput" value="<?=$no-1?>" readonly style="display: none;">
<?php
  





?>