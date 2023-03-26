<?php
include "../private/connlogin.php";
include "../private/functions.php";

// global $fun, $client, $ref;
$fun = $_GET['q'];
// $client = $_GET['clt'];


function getReference(){
    include "../private/connlogin.php";
    $client = $_GET['clt'];
    $refSql = $conn->prepare("SELECT contract_no, reference_no, sum(qty), (SELECT sum(allocated_qty) 
    FROM contract_stock_allocation WHERE contracts_summary.contract_no=contract_stock_allocation.contract_no) as allocated 
    FROM contracts_summary JOIN contract_offers USING (contract_no) 
    WHERE customer_id=? GROUP BY contract_no");
    $refSql->bind_param("s", $client);
    $refSql->execute();
    $refSql->bind_result($contNum, $ref, $contQty, $allocated);
    echo '<option value="">--Select Reference--</option>';
    while ($refSql->fetch()){
        ?>
        <option value="<?=$contNum?>"><?=$ref?></option>
        <?php
    }
}

function getSummary(){
    include "../private/connlogin.php";
    $no = $_GET['no'];
    $refSql = $conn->prepare("SELECT country_name, shipment_date, incoterms, sum(qty), (SELECT sum(allocated_qty) 
    FROM contract_stock_allocation WHERE contracts_summary.contract_no=contract_stock_allocation.contract_no) as allocated, currency
    FROM contracts_summary JOIN countries USING (country_id) JOIN contract_offers USING (contract_no) WHERE contract_no=?");
    $refSql->bind_param("s", $no);
    $refSql->execute();
    $refSql->bind_result($country, $shipDate, $incoterms, $contQty, $allocated, $currency);
    $refSql->fetch();
    $refSql->close();

    $result = array($country, $shipDate, $incoterms, $contQty, $allocated, $currency);
    $data = json_encode($result);
    echo $data;
}

function contractItems(){
    include "../private/connlogin.php";
    $no = $_GET['no'];
    $grdSql=$conn->prepare("SELECT grade_id, grade_name FROM contract_offers JOIN grades USING (grade_id) WHERE contract_no=?");
    $grdSql->bind_param("s", $no);
    $grdSql->execute();
    $grdSql->bind_result($grdId, $grdName);
    echo '<option value=""></option>';
    while ($grdSql->fetch()){
        ?>
        <option value="<?=$grdId?><?=$grdName?>"><?=$grdName?></option>
        <?php
    }
}

//get qtys
function getQtys(){
    include "../private/connlogin.php";
    $no = $_GET['no'];
    $grdId = $_GET['grd'];
    $qtySql = $conn->prepare("SELECT qty FROM contract_offers WHERE (contract_no=? AND grade_id=?)");
    $qtySql->bind_param("is", $no, $grdId);
    $qtySql->execute();
    $qtySql->bind_result($contQty);
    $qtySql->fetch();
    $qtySql->close();

    $allocSql = $conn->prepare("SELECT sum(allocated_qty) FROM contract_stock_allocation WHERE (contract_no=? AND grade_id=?)");
    $allocSql->bind_param("is", $no, $grdId);
    $allocSql->execute();
    $allocSql->bind_result($allocQty);
    $allocSql->fetch();
    $allocSql->close();
    if ($allocQty==""){
        $allocQty=0;
    }

    $result = json_encode(array($contQty, $allocQty, ($contQty-$allocQty)));
    echo $result;
}

//get vauations
function getValuations(){
    include "../private/connlogin.php";
    include "../private/verAndApprFunctions.php";
    // $no = $_GET['no'];
    $grdId = $_GET['grd'];
    $sql=$conn->prepare("SELECT document_number, sum(qty_in), (SELECT sum(allocated_qty) FROM contract_stock_allocation
    WHERE inventory_reference='Valuation Report' AND contract_stock_allocation.document_number=inventory.document_number 
    AND grade_id=?) AS qty2 FROM inventory WHERE inventory_reference='Valuation Report' AND grade_id=? 
    AND contract_allocation=1 GROUP BY document_number");
    $sql->bind_param("ss", $grdId, $grdId);
    $sql->execute();
    $sql->bind_result($valNo, $valQty, $allocQty);
    // $sql->close();
    
    echo '<option value="Open">Open Stock</option>';
    while ($sql->fetch()){
        
        if ($allocQty<$valQty){
            ?>
            <option value="<?=$valNo?>"><?='VAL-'.$valNo ?></option>
            <?php
        }
    }
}

function getValQty(){
    include "../private/connlogin.php";
    $valNo = $_GET['no'];
    $grdId = $_GET['grd'];
    $sql=$conn->prepare("SELECT sum(qty_in), (SELECT sum(allocated_qty) FROM contract_stock_allocation
    WHERE inventory_reference='Valuation Report' AND contract_stock_allocation.document_number=inventory.document_number 
    AND grade_id=?) AS qty2 FROM inventory WHERE inventory_reference='Valuation Report' AND grade_id=?
    AND contract_allocation=1 AND document_number=?");
    $sql->bind_param("ssi", $grdId, $grdId, $valNo);
    $sql->execute();
    $sql->bind_result($valQty, $allocQty);
    $sql->fetch();
    if ($allocQty<$valQty){
        echo $valQty-$allocQty;
    }
    
}


if ($fun=="getReference"){
    getReference();
}elseif($fun=="getSummary"){
    getSummary();
}elseif($fun=="getItems"){
    contractItems();
}elseif($fun=="getQtys"){
    getQtys();
}elseif($fun=="getVal"){
    getValuations();
}elseif($fun=="getValQty"){
    getValQty();
}
?>