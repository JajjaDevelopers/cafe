<?php
include "../private/connlogin.php";
$fun = $_GET['selFun'];
function getClient(){
    include "../private/connlogin.php";
    
    $grd = $_GET['selGrade'];

    $sql = $conn->prepare("SELECT customer_id, customer_name FROM grn JOIN customer USING (customer_id)
                            WHERE grade_id=? AND grn_status='Pending Processing' AND purpose='Processing' AND batch_order_no=0");
    $sql->bind_param("s", $grd); //bind_param("ss", $client, $grd)
    $sql->execute();
    $sql->bind_result($id, $name);
    echo '<option></option>';
    while ($sql->fetch()){
        ?>
        <option value="<?=$id?>"><?=$name?></option>
        <?php
    }
}

function getGrn(){
    include "../private/connlogin.php";
    $client = $_GET['selClient'];
    $grd = $_GET['selGrade'];

    $sql = $conn->prepare("SELECT grn_no FROM grn WHERE grade_id=? AND customer_id=? AND grn_status='Pending Processing' 
                            AND purpose='Processing'"); //WHERE customer_id=? AND grade_id=? AND grn_status='Pending Processing'
    $sql->bind_param("ss", $grd, $client); //bind_param("ss", $client, $grd)
    $sql->execute();
    $sql->bind_result($grn);
    echo '<option>--select--</option>';
    while ($sql->fetch()){
        ?>
        <option value="<?=$grn?>"><?=$grn?></option>
        <?php
    }
}

// get grn qty
function getQty($grn, $request){
    include "../private/connlogin.php";
    $sql = $conn->prepare("SELECT $request FROM grn WHERE grn_no=?");
    $sql->bind_param("i", $grn);
    $sql->execute();
    $sql->bind_result($qty);
    $sql->fetch();
    echo $qty;
    $sql->close();
}





if ($fun == "getGrns"){
    getGrn();
}elseif($fun == "getQty"){
    $grn = $_GET["selGrn"];
    getQty($grn, "grn_qty");
}elseif($fun == "getGrn"){
    $grn = $_GET["selGrn"];
    getQty($grn, "grn_mc");
}elseif($fun == "getClient"){
    getClient();
}

?>