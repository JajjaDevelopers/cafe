<?php $pageTitle="Contract Offer";
include_once ("../forms/header.php");
include "../private/contractOfferVariables.php";
?>
<form class="regularForm" method="post" action="../connection/contractOffer.php" style="width: 800px; height:fit-content">
    <h3 class="formHeading">Contract Offer</h3>
    <?php include "../templates/contractOffer.php" ?>


</form>
<?php include "../forms/footer.php" ?>