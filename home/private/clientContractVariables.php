<?php

include ("../private/connlogin.php");
include "../private/functions.php";
$contNo = $_GET["contNo"];
// $stt = $_GET["stt"];
// if ($stt=='1'){
//     $status="Pending Stock Allocation";
// }elseif($stt=='2'){
//     $status="Pending Shipment";
// }

$newBatchNo = "CRT-".$contNo;
$no = intval($contNo);
$_SESSION['offerNum']=$no;
$offerNum = $_SESSION['offerNum'];

$summSql = $conn->prepare("SELECT customer_id, customer_name, country_name, continent, reference_no, contract_date, 
                incoterms, sourcing_actions, financing_source, remarks, prepared_by, contact_person, 
                telephone, (SELECT currency FROM contract_offers WHERE contract_no=? LIMIT 1) AS currecnty, cotract_type, 
                container_size, contracts_summary.category
                FROM contracts_summary
                JOIN countries USING (country_id) JOIN customer USING (customer_id)  WHERE contract_no=?");
$summSql->bind_param("ii", $offerNum, $offerNum);
$summSql->execute();
$summSql->bind_result($cltId, $cltName, $countryName, $continent, $contRef, $contDate, $terms, $sourcing, 
                    $financing, $remarks, $prepared_by, $cltTel, $cltContact, $currency, $contType, $contSize, $category);
$summSql->fetch();
$summSql->close();


//items

function contractsOfferTable(){
    include ("../private/connlogin.php");
    global $no, $contSize;
    global $ttQty, $ttValue;
    $detSql = $conn->prepare("SELECT item_no, grade_id, grade_name, grade_description, containers, bags, qty, price_ref, currency,
                    avg_price, quality_premium, social_premium, gi_premium, shipment_date FROM contract_offers 
                    JOIN grades USING (grade_id)
                    WHERE contract_no=?");
    $detSql->bind_param("i", $no);
    $detSql->execute();
    $detSql->bind_result($itmNo, $grdId, $grdName, $grdDesc, $containers, $bags, $qty, $pxRef, $currency, $price, $qltPrem, $socPrem, $giPrem, 
                            $shipDate);

    $x=1;
    $ttQty=0;
    $ttValue=0;
    while ($detSql->fetch()){ //check the length of pick item function
        $amount = $price+$giPrem+$socPrem+$qltPrem;
        $ttQty+=$qty;
        $ttValue+=$qty*$price;
        ?>
        <tr>
            <td><?=$x?></td>
            <td style="display: none;"><input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px"></td>
            <td id="<?='item'.$x.'Name'?>" name="<?='item'.$x.'Name'?>"><?=$grdName?></td>
            <td id="<?='item'.$x.'QualitySpecs'?>" name="<?='item'.$x.'QualitySpecs'?>"><?=$grdDesc?></td>
            <td><input type="text" value="<?=$containers?>" id="<?='item'.$x.'Containers'?>"  name="<?='item'.$x.'Containers'?>" class="tblNum" step="0.01" ></td>
            <td><input type="text" value="<?=$bags?>" id="<?='item'.$x.'Bags'?>"  name="<?='item'.$x.'Bags'?>" class="tblNum" step="0.01" ></td>
            <td><input type="text" value="<?=num($qty)?>" id="<?='item'.$x.'Qty'?>"  name="<?='item'.$x.'Qty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
            <td id="<?='item'.$x.'pxRef'?>"  name="<?='item'.$x.'pxRef'?>"><?=$pxRef?></td>
            <td><input type="text" value="<?=num($price)?>" id="<?='item'.$x.'Price'?>"  name="<?='item'.$x.'Price'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($giPrem)?>" id="<?='item'.$x.'GiPrem'?>"  name="<?='item'.$x.'GiPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($socPrem)?>" id="<?='item'.$x.'SocialPrem'?>"  name="<?='item'.$x.'SocialPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($qltPrem)?>" id="<?='item'.$x.'QualityPrem'?>"  name="<?='item'.$x.'QualityPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($amount)?>" id="<?='item'.$x.'AMount'?>" readonly name="<?='item'.$x.'AMount'?>" step="0.001" class="tblNum"></td>
            <td><input type="text" value="<?=$shipDate?>" id="<?='item'.$x.'ShipDate'?>" name="<?='item'.$x.'ShipDate'?>" class="tableInput" style="width: 90px;"></td>

        </tr>
        <script>document.getElementById("<?='item'.$x.'Select'?>").style.display="none"; </script>
        <?php
        $x+=1;
    }
}

//terms
function terms(){
    include ("../private/connlogin.php");
    global $no;
    $sql = $conn->prepare("SELECT no, term FROM offer_terms WHERE contract_no=?");
    $sql->bind_param("i", $no);
    $sql->execute();
    $sql->bind_result($tNo, $term);
    while($sql->fetch()){
        ?>
        <tr style="border:0px solid">
            <td style="border:0px solid"><?=$tNo.'.'?></td>
            <td style="width: 800px; border:0px solid"><?=$term?></td>
        </tr>
        <?php
    }
}
?>