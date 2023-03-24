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
$shipdDate = $_POST['shipdDate'];
$customer_id = $_POST["customerId"];
$sourcingNotes = $_POST["sourcing"];
$financingSource = $_POST["financing"];

if ($offerDate != "" && $customer_id != ""){
    //Capturing summary
    $offerSummary = $conn->prepare("INSERT INTO contracts_summary (contract_no, customer_id, country_id, reference_no, contract_date, 
                            shipment_date, incoterms, sourcing_actions, financing_source, prepared_by)
                            VALUES (?,?,?,?,?,?,?,?,?,?)");
    $offerSummary->bind_param("isisssssss", $contractNo, $customer_id, $country, $reference, $offerDate, $shipdDate, $terms,
    $sourcingNotes, $financingSource, $prepared_by);
    $offerSummary->execute();

    //update contract offers
    $offerSql = $conn->prepare("INSERT INTO contract_offers (contract_no, grade_id, grade_description, qty, avg_price, currency) 
                                VALUES (?,?,?,?,?,?)");
    for ($x=1;$x<=6;$x++){
        $qty = $_POST['item'.$x.'Qty'];
        if ($qty > 0){
            $grd = $_POST['item'.$x.'Code'];
            $grdDesc = $_POST['item'.$x.'Name'];
            $grdPx = $_POST['item'.$x.'Price'];
            $offerSql->bind_param("issdds", $contractNo, $grd, $grdDesc, $qty, $grdPx, $currency);
            $offerSql->execute();
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