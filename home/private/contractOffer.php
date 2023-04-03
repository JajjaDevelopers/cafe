<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"];
include ("connlogin.php");
include "functions.php";

$contractNo = documentNumber("contracts_summary", "contract_no");
$offerDate = $_POST["date"];
$reference = $_POST['reference'];
$currency = $_POST['currency'];
$terms = $_POST['incoterms'];
$country = $_POST['country'];
$customer_id = $_POST["customerId"];
$sourcingNotes = $_POST["sourcing"];
$contCategory = $_POST["contCategory"];
$status = "Pending Confirmation";
$pricingTerm = "Price USD per MT FOT Kampala";
$contSize = $_POST["containerSize"];
$contType = $_POST["contType"];

if ($offerDate != "" && $customer_id != ""){
    //Capturing summary
    $offerSummary = $conn->prepare("INSERT INTO contracts_summary (contract_no, customer_id, country_id, reference_no, contract_date, 
                        category, offer_status, pricing_term, container_size, incoterms, cotract_type, sourcing_actions, financing_source,
                        prepared_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $offerSummary->bind_param("isisssssssssss", $contractNo, $customer_id, $country, $reference, $offerDate, $contCategory, $status, 
                        $pricingTerm, $contSize, $terms, $contType, $sourcingNotes, $financingSource, $prepared_by);
    $offerSummary->execute();

    //update contract offers
    $offerSql = $conn->prepare("INSERT INTO contract_offers (contract_no, item_no, grade_id, grade_description, containers, bags, qty, 
                        price_ref, currency, avg_price, quality_premium, social_premium, gi_premium, shipment_date) 
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $itemNo = 1;
    for ($x=1;$x<=6;$x++){
        $qty = $_POST['item'.$x.'Qty'];
        if ($qty > 0){
            $grd = $_POST['item'.$x.'Code'];
            $grdDesc = $_POST['item'.$x.'QualitySpecs'];
            $grdPx = $_POST['item'.$x.'Price'];
            $containers = $_POST['item'.$x.'Containers'];
            $bags = $_POST['item'.$x.'Bags'];
            $pxRef = $_POST['item'.$x.'pxRef'];
            $qualPrem = $_POST['item'.$x.'QualityPrem'];
            $socPrem = $_POST['item'.$x.'SocialPrem'];
            $giPrem = $_POST['item'.$x.'GiPrem'];
            $shipDate = $_POST['item'.$x.'ShipDate'];
            $offerSql->bind_param("iissiidssdddds", $contractNo, $itemNo, $grd, $grdDesc, $containers, $bags, $qty, $pxRef, $currency, 
            $grdPx, $qualPrem, $socPrem, $giPrem, $shipDate);
            $offerSql->execute();
            $itemNo+=1;
        }
    }

    $termSql = $conn->prepare("INSERT INTO offer_terms (contract_no, no, term) VALUES (?,?,?)");
    $t=1;
    for ($x=1;$x<=15;$x++){
        $term = $_POST['term'.$x];
        if ($term!=""){
            $termSql->bind_param("iis", $contractNo, $t, $term);
            $termSql->execute();
            $t+=1;
        }

    }
    

    

    if(isset($_POST["btnsubmit"]))
    {
        header("location:../marketing/contractOffer?formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../marketing/contractOffer?formmsg=fail");
        }

}

?>