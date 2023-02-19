<?php
// require_once "connlogin.php";
//function that tests for empty fields

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days;

function emptyFieldSignUp($fullname,$username,$email,$tel,$password,$passwordRepeat,$access)
{
  if(empty($fullname)||empty($username)||empty($email)||empty($tel)||empty($password)||empty($passwordRepeat)||empty($access))
  {
    $result=true;
  } else
  {
    $result=false;
  }

  return $result;
}

//function that checks for validity of user name
function validUsername($username)
{
  if(!preg_match("/^[a-zA-Z0-9]*$/",$username))//makes sure username is alphanumeric
  {
    $result=true;
  } else {
    $result=false;
  }
  return $result;
}

//function that checks for validity of email address
function validEmail($email)
{
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $result=true;
  }else{
    $result=false;
  }

  return $result;
}

//function that checks for validity of mobile number
function validMobile($tel)
{
  if(!is_numeric($tel))
  {
    $result=true;
  }else{
    $result=false;
  }
  return $result;
}

//function that checks whether passwords match
function pwdMatch($password,$passwordRepeat){
  if($password!==$passwordRepeat){
   $result=true;
  }else{
   $result=false;
  }
  return $result;
 }


 //function that checks whether username or email already exists
 function validUsernameEmail($username,$email)
 {
  include "connlogin.php";//including in database connection details
  $query="SELECT * FROM members WHERE UserName=? OR EmailAddress=?";
  $stmt=$pdo->prepare($query);
  if(!$stmt)//checking for database connection failure;
  {
    header("location:..forms/signup.php?error=stmtfailed");
    exit();
  }
  $stmt->bindParam(1,$username,PDO::PARAM_STR);//binding parameters
  $stmt->bindParam(2,$email,PDO::PARAM_STR);
  $stmt->execute();

  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if($row)
  {
    return $row;
  }else{
    $result=false;
    return $result;
  }

  $pdo=null;//closing database connection

 }
 
 //function that signs up user;
 function signUpUser($fullname,$username,$email,$tel,$password,$access)
 {
  

 include "connlogin.php";

  $query="INSERT INTO members(FullName,UserName,EmailAddress,Telephone,UserPassword,Access)
  VALUES(?,?,?,?,?,?)";
  $stmt=$pdo->prepare($query);
  
  if(!$stmt)
  {
    header("location:..forms/signup?error=stmtfailed");
    exit();
  }

  $passwordHashed=password_hash($password,PASSWORD_DEFAULT);
  $stmt->bindParam(1,$fullname,PDO::PARAM_STR);
  $stmt->bindParam(2,$username,PDO::PARAM_STR);
  $stmt->bindParam(3,$email,PDO::PARAM_STR);
  $stmt->bindParam(4,$tel,PDO::PARAM_INT);
  $stmt->bindParam(5,$passwordHashed,PDO::PARAM_STR);
  $stmt->bindParam(6,$access,PDO::PARAM_INT);
  $stmt->execute();
  $pdo=null;
  header("location:../forms/signup?error=successfully");
  exit();
 }
 
 function sanitize_table($tabledata)
 {
     $tabledata=stripslashes($tabledata);
     $tabledata=strip_tags($tabledata);
     $tabledata=htmlentities($tabledata);
     return $tabledata;
 }

 
// Getting next document number for front end
function nextDocNumber($table, $columName, $prefix){
  include "connlogin.php"; 
  $nextNoSql = "SELECT max($columName) AS numbers FROM $table";
  $nextNoQuery = $conn->query($nextNoSql);
  $nextNoResult = mysqli_fetch_array($nextNoQuery);
  $number = $nextNoResult['numbers'];
  $nextNo = intval($number) +1;
  $docNumber = "";
  if ($number === 0){
    $docNumber = $prefix."-0001";
  }else{
    if ($nextNo<10){
        $docNumber = $prefix."-000".$nextNo;
    }
    elseif ($nextNo<100){
        $docNumber = $prefix."-00".$nextNo;
    }elseif ($nextNo<1000){
        $docNumber = $prefix."-0".$nextNo;
    }else{
      $docNumber = $prefix."-".$nextNo;}
    }
  return $docNumber;
}


// database table document number
function documentNumber($table, $columName){
  include "connlogin.php"; 
  $nextNoSql = "SELECT max($columName) AS numbers FROM $table";
  $nextNoQuery = $conn->query($nextNoSql);
  $nextNoResult = mysqli_fetch_array($nextNoQuery);
  $number = $nextNoResult['numbers'];
  return intval($number) +1;
}


// Customer List
function GetCustomerList(){
  include "connlogin.php"; 
  $queryCustomer = "SELECT customer_id, customer_name FROM customer";
  if ($stmt = $conn->prepare($queryCustomer)) {
  $stmt->execute();
  $stmt->bind_result($customer_id, $customer_name);
  echo '<option></option>';
  while ($stmt->fetch()) {
      echo '<option value="'.$customer_id.' '.$customer_name.'">'.$customer_id.' '.$customer_name.'</option>';
  }
  $stmt->close();
  }
}

// Customer IDs list
function clientPicker(){
  include "connlogin.php"; 
  $queryCustomer = "SELECT customer_id, customer_name FROM customer";
  if ($stmt = $conn->prepare($queryCustomer)) {
  $stmt->execute();
  $stmt->bind_result($customer_id, $customer_name);
  ?><option value="all">Clients</option><?php
  while ($stmt->fetch()) {
    ?>
      <option value="<?=$customer_id?>"><?=$customer_name?></option>
      <?php
  }
  $stmt->close();
  }
}


// All Coffee Grades
function coffeeGrades(){
  include "connlogin.php"; 
  $query = "SELECT grade_id, grade_name FROM grades";
  if ($stmt = $conn->prepare($query)) {
      $stmt->execute();
      $stmt->bind_result($grade_id, $grade_name);
      echo '<option></option>';
      while ($stmt->fetch()) {
          echo "<option value='".$grade_id."--".$grade_name."'>$grade_name</option>";
      }
      $stmt->close();
  }
}

function selectCoffeeGrades(){
  include "connlogin.php"; 
  $query = "SELECT grade_id, grade_name FROM grades";
  if ($stmt = $conn->prepare($query)) {
      $stmt->execute();
      $stmt->bind_result($grade_id, $grade_name);
      echo '<option></option>';
      while ($stmt->fetch()) { ?>
          <option value="<?=$grade_id?>"><?=$grade_name?></option><?php
      }
      $stmt->close();
  }
}


// Coffee Grades according to coffee type
function coffeeTypeGrades($type){
  include "connlogin.php"; 
  $sql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE coffee_type=?");
  $sql->bind_param("s", $type);
  $sql->execute();
  $sql->bind_result($grade_id, $grade_name);
  echo '<option></option>';
  while ($sql->fetch()) {
      echo "<option value='".$grade_id."--".$grade_name."'>$grade_name</option>";
  }
  $sql->close();
  }


// Valuation customer Picker
function valuationCustomer(){
  include "connlogin.php"; 
  $sql = "SELECT batch_report_no, customer_name, grade_name, batch_order_input_qty FROM batch_reports_summary
          JOIN batch_processing_order USING (batch_order_no)
          JOIN grn USING (batch_order_no)
          JOIN grades USING(grade_id)
          JOIN customer USING (customer_id)
          WHERE (valuation_status=0 AND offtaker='NUCAFE')";
  $getList = $conn->query($sql);
  $row = mysqli_fetch_all($getList);
  echo "<option>Select Batch to Value</option>";
  for ($supplier=0; $supplier<count($row); $supplier++){
      
      echo "<option>".$row[$supplier][0]."--".$row[$supplier][1]."--".$row[$supplier][2]."--".$row[$supplier][3]." Kg"."</option>";
  }
}


// Generating Valuation Row
function valuationItemRow($itemNo){

echo '<tr>
    <td>
        <div id="item'.$itemNo.'Field" style="display: grid;" class="itemName">';
            echo '<input type="text" value="" id="highGrade'.$itemNo.'Code" readonly name="highGrade'.$itemNo.'Code" class="itmNameInput" style="grid-column: 1; display:none;">';
            echo '<input type="text" value="" id="highGrade'.$itemNo.'Name" readonly name="highGrade'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">';
            echo '<select id="highGrade'.$itemNo.'Select" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">';
                CoffeeGrades();
            echo '</select>
        </div>
        
    </td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'Yield" readonly name="highGrade'.$itemNo.'Yield" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'Qty" name="highGrade'.$itemNo.'Qty" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceUs" name="highGrade'.$itemNo.'PriceUs" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceCts" name="highGrade'.$itemNo.'PriceCts" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceUgx" name="highGrade'.$itemNo.'PriceUgx" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'AmountUs" readonly name="highGrade'.$itemNo.'AmountUs" class="tblNum"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'AmountUgx" readonly name="highGrade'.$itemNo.'AmountUgx" class="tblNum"></td>
    </tr>';
}


// Activity Sheet Item Row
function activitySheetItems($itemNo){
  ?>
  <tr>
    <td>
      <input type="text" value="" id="itm<?=$itemNo?>Code" readonly name="itm<?=$itemNo?>Code" class="itmNameInput" style="grid-column: 1; display:none">
      <input type="text" value="" id="itm<?=$itemNo?>Name" readonly name="itm<?=$itemNo?>Name" class="itmNameInput" style="grid-column: 2; width: 360px">
      <select id="itm<?=$itemNo?>Select" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect"
      onchange="selectItemx(this.id, )">
        <?php getRoastedItems(); ?>
      </select>
    </td>
    <td ><input type="number" value="0" id="itm<?=$itemNo?>Qty" name="itm<?=$itemNo?>Qty" class="tableInput" style="height: 100%;" ></td>

  <?php
}

//Item services
function activityServices($itemNo){
  ?>
  <tr>
    <td>
      <input type="text" value="" id="svc<?=$itemNo?>Code" readonly name="svc<?=$itemNo?>Code" class="itmNameInput" style="grid-column: 1; display:none">
      <input type="text" value="" id="svc<?=$itemNo?>Name" readonly name="svc<?=$itemNo?>Name" class="itmNameInput" style="grid-column: 2; width: 300px">
      <select id="svc<?=$itemNo?>Select" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itmNameInput"
      onchange="selectService(this.id)">
        <?php getServices(); ?>
      </select>
    </td>
    <td ><input type="number" value="" id="svc<?=$itemNo?>Qty" name="svc<?=$itemNo?>Qty" class="tableInput" 
    style="height: 100%;" onblur="updateQty()"></td>
    <td ><input type="number" value="" id="svc<?=$itemNo?>Rate" name="svc<?=$itemNo?>Rate" class="tableInput"
    onblur="updateQty()"></td>
    <td><input type="number" value="" id="svc<?=$itemNo?>Amount" name="svc<?=$itemNo?>Amount" class="tableInput" readonly></td>
  <?php
}


// Getting services
function getServices(){
  include "connlogin.php"; 
  $query = "SELECT grade_id, grade_name FROM grades WHERE inventory_type='SERVICE'";
  if ($svcSql = $conn->prepare($query)) {
    $svcSql->execute();
    $svcSql->bind_result($grade_id, $grade_name);
    echo '<option></option>';
    while ($svcSql->fetch()) {
        echo "<option value='".$grade_id."--".$grade_name."'>$grade_name</option>";
    }
    $svcSql->close();
  }
} 


//roastery items
function getRoastedItems(){
  include "connlogin.php"; 
  $query = "SELECT grade_id, grade_name FROM grades WHERE (inventory_type='ITEM' AND grade_type='ROASTED')";
  if ($svcSql = $conn->prepare($query)) {
    $svcSql->execute();
    $svcSql->bind_result($grade_id, $grade_name);
    echo '<option></option>';
    while ($svcSql->fetch()) {
        echo "<option value='".$grade_id."--".$grade_name."'>$grade_name</option>";
    }
    $svcSql->close();
  }
}

// Batch Report customer list
function selectBatchReportCustomer(){
  include "connlogin.php"; 
  $sql = "SELECT customer_id, customer_name FROM batch_processing_order
          JOIN grn USING (batch_order_no) 
          JOIN customer USING (customer_id) 
          WHERE (processed=0)
          GROUP BY customer_id";
  $getList = $conn->query($sql);
  $row = mysqli_fetch_all($getList);
  if (count($row)==0){
      echo "<option>  There was no processing order found!</option>";
  }else{
      echo "<option>Select Processing Order</option>";
      for ($customer=0; $customer<count($row); $customer++){
          ?>
          <option value="<?= $row[$customer][0] ?>"><?= $row[$customer][1] ?></option>
          <?php
      }
  }
}


//Batch Order Customer Selector
function batchOrderCustomer(){
  include "connlogin.php"; 
  $stmt = "SELECT grn_no, grn.customer_id, customer_name, grade_name, grn_qty FROM grn
          JOIN customer USING(customer_id)
          JOIN grades USING(grade_id)
          WHERE (purpose='Processing' AND batch_order_no=0)
          GROUP BY customer_id";
  $custQuery = $conn->prepare($stmt);
  $custQuery->execute();
  $custQuery->bind_result($grn_no, $customer_id, $customer_name, $grade_name, $grn_qty);
  $rows = mysqli_affected_rows($conn);
  echo '<option></option>';
  while ($custQuery->fetch()){
    ?>
    <option value="<?=$customer_id?>"><?=$customer_name?></option>
    <?php
  }
}

function hullingCustomer(){
  include "connlogin.php"; 
  $stmt = "SELECT grade_name, grn.customer_id, customer_name, grade_name, grn_qty FROM grades
          JOIN customer USING(customer_id)
          JOIN grades USING(grade_id)
          WHERE (purpose='Processing' AND batch_order_no=0)
          GROUP BY customer_id";
  $custQuery = $conn->prepare($stmt);
  $custQuery->execute();
  $custQuery->bind_result($grn_no, $customer_id, $customer_name, $grade_name, $grn_qty);
  $rows = mysqli_affected_rows($conn);
  echo '<option></option>';
  while ($custQuery->fetch()){
    ?>
    <option value="<?=$customer_id?>"><?=$customer_name?></option>
    <?php
  }
}


//include gradePicker.js for this function for pages that call it
function gradePicker($itemId, $gradeOption){
  include "connlogin.php"; 
  ?>
  <input type="text" value="" id="<?= $itemId.'Code' ?>" readonly name="<?= $itemId.'Code' ?>" class="itmNameInput" style="grid-column: 1; display:none">
  <input type="text" value="" id="<?= $itemId.'Name' ?>" readonly name="<?= $itemId.'Name' ?>" class="itmNameInput" style="grid-column: 2; width: 250px">
              
  <select id="<?= $itemId ?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">
   <?php
   if ($gradeOption == "husks"){
    coffeeTypeGrades("NONE");
   }elseif($gradeOption == "otherLoss"){
    coffeeTypeGrades("NONE");
   }else{
    coffeeGrades();
  }
   
   ?>
  </select>
  
  <?php
  }


  //document notes
  function documentNotes($width){
    global $comment;
    ?>
    <div style="margin-top: 10px; max-height: 50px;">
        <label for="notes">Notes:</label><br>
        <input id="notes" name="notes" class="shortInput" value="<?=$comment?>" maxlength="100" style="width: <?= $width?>;">
    </div><br>
    <?php
  }


  //select block
  function selectWarehouseBlock(){
    ?>
        <option>Block</option>
        <?php
        for ($block=1; $block<=6; $block++) {
          ?>
            <option value="<?= $block ?>"><?= 'Block '.$block ?></option>
            <?php
        }
    }
  


  //warehouse selection
  
function itemsTable($itemsNo, $tableHeading){
  
  ?>
  <h6 style="margin-top: 20px;"><?= $tableHeading?></h6>
  <table style="margin-top: 5px;" >
    <tr>
      <th style="width: 40px;">No.</th>
      <th>Grade</th>
      <th>Moisture</th>
      <th>Bags</th>
      <th>Quantity</th>
    </tr> 
  <?php 
  for ($i=1; $i<=$itemsNo; $i++){
    ?>
    <tr>
      <td><?= $i ?></td>
      <td>
        <input id="<?= 'item'.$i.'Id'?>" name="<?= 'item'.$i.'Id'?>" class="itmNameInput" readonly style="display: none;">
        <input id="<?= 'item'.$i.'Name'?>" class="itmNameInput" style="width: 300px;" readonly>
        <select id="<?= 'item'.$i.'Select'?>" name="<?= 'item'.$i.'Select'?>" class="dropdown" onchange="selectItem(this.id, <?= $itemsNo?>)" >
        <?php coffeeGrades(); ?></select>
      </td>
      <td><input type="number" id="<?= 'item'.$i.'Mc'?>" name="<?= 'item'.$i.'Mc'?>" class="tableInput" style="width: 60px;" 
      step="0.01" onchange = "updateItemMc(<?= $itemsNo ?>)" ></td>
      <td><input type="number" id="<?= 'item'.$i.'Bags'?>" name="<?= 'item'.$i.'Bags'?>" class="tableInput" style="width: 60px;" 
      step="0.1" onchange="updateItemBags(<?= $itemsNo ?>)" ></td>
      <td><input type="number" id="<?= 'item'.$i.'Qty'?>" name="<?= 'item'.$i.'Qty'?>" class="tableInput" style="width: 100px;" 
      step="0.01" onchange="updateItemQty(<?= $itemsNo ?>)" ></td>
    </tr>
  <?php
  }
  ?>
  <tr>
    <th colspan="2">Total</th>
    <th><input readonly type="number" id="avgMc" name="avgMc" class="tableInput" style="width: 60px;" step="0.01"></th>
    <th><input readonly type="number" id="totalBags" name="totalBags" class="tableInput" style="width: 60px;" step="0.1"></th>
    <th><input readonly type="number" id="totalQty" name="totalQty" class="tableInput" style="width: 100px;" step="0.01"></th>
  </tr>
  </table> 
  <?php 
}


//Next button
function insertNextButton(){
  ?>
  <div id="activityPrepareDiv">
    <input type="submit" id="nextButton" value="Next" class="controlButtons btn btn-primary" name="btnsubmit">
  </div>
  <?php
}

function customerFill(){
  global $customerId, $customerName, $contactPerson, $customerTel;
  ?>
  
  <div id="customerDetailsDiv">
    <label for="customerId" class="salesReportLabel" >Client:</label>
    <input type="text" id="customerId" name="customerId" readonly class="longInputField" value="<?= $customerId?>" style="width: 70px; margin-right: 0px;" >
    <input type="text" id="customerName" name="customerName" readonly class="longInputField" value="<?= $customerName?>" style="margin-left: 0px; margin-right: 0px; width: 250px"><br>
    <label for="customerContact" id="salesReportBuyerLabel"  class="salesReportLabel" >Contact:</label>
    <input type="text" id="contactPerson" name="contactPerson" readonly class="longInputField" value="<?= $contactPerson?>" style="margin-right: 0px; width:150px">
    <label for="customerTel" class="salesReportLabel" >Tel:</label>
    <input type="text" id="customerTel" name="customerTel" readonly class="longInputField" value="<?= $customerTel?>" style="margin-right: 0px; width:120px">
  </div>
  <?php
}

//Getting regions
function getRegion(){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT region FROM districts GROUP BY region");
  $sql->execute();
  $sql->bind_result($region);
  ?><option>Regions</option><?php
  while ($sql->fetch()){
      ?><option value="<?=$region?>"><?=$region?></option><?php
  }
}

//comment div
function comment($width){
  ?>
  <div style="margin-top: 20px;">
  <label for="comment" >Comment:</label><br>
    <input id="comment" name="comment" class="shortInput" style="width: <?=$width?>;" required>
    </div>
  <?php
}

//getting names
function getName($table, $column, $keyColumn, $key){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT $column FROM $table WHERE $keyColumn=?");
  $sql->bind_param("s", $key);
  $sql->execute();
  $sql->bind_result($fullName);
  $sql->fetch();
  $sql->close();
  return $fullName;
}

//exchange rate retrieval
function getFx(){
  include "connlogin.php";
  $curDate = new DateTime();
  $date = date_format($curDate, 'Y-m-d');
  $sql = $conn->prepare("SELECT rate FROM exchange_rate WHERE rate_date=?");
  $sql->bind_param("s", $date);
  $sql->execute();
  $sql->bind_result($rate);
  $sql->fetch();
  return $rate;
}

//Fx history
function previousFx(){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT rate_date, currency, rate, reference FROM exchange_rate
                        ORDER BY rate_date DESC LIMIT 20");
  $sql->execute();
  $sql->bind_result($date, $currency, $rate, $ref);
  ?>
  <div style="border-radius: 10px; border: solid 1px green; padding: 5px" >
  <table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
      <tr style="background-color: green; color: white; ">
        <th style="text-align: center; width: 150px;">Date</th>
        <th style="text-align: center;">Currency</th>
        <th style="text-align: center;">Rate</th>
        <th style="text-align: center;">Reference</th>
      </tr>
    </thead>
    <tbody>
  <?php
  while ($sql->fetch()){
    ?>
    <tr>
      <td><?= $date ?></td>
      <td><?= $currency ?></td>
      <td style="text-align: center;"><?= $rate ?></td>
      <td><?= $ref ?></td>
    </tr>
    <?php
  }
  ?>
    </tbody>
  </table>
  </div>
  <?php
}

//dates
$currentDate = new DateTime();
$today = date_format($currentDate, 'Y-m-d');
// $fromDateObj=$currentDate->sub(new DateInterval('P30D')); //returning 30 days back date
// $fromDate = date_format($fromDateObj, 'Y-m-d');

//forex
$fxRate = getFx();

//getting users names
function userFullName($userName){
  include "connlogin.php";
  $userSql = $conn->prepare("SELECT FullName FROM members WHERE UserName=?");
  $userSql->bind_param("s", $userName);
  $userSql->execute();
  $userSql->bind_result($fullName);
  $userSql->fetch();
  $userSql->close();
  return $fullName;
}

//pending dispatch list
function pendingDispatch(){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT release_no, request_date, customer_name, FullName FROM release_request
                        JOIN customer USING (customer_id) JOIN members ON release_request.prep_by=members.UserName
                        WHERE verified_by <> '0' AND appr_by <> '0' AND status=1");
  $sql->execute();
  $sql->bind_result($rel_no, $req_date, $cus_name, $user_name);
  while ($sql->fetch()){
    ?>
    <tr>
      <td><a href="../inventory/dispatch?relNo=<?=$rel_no?>"> <?=$rel_no?> </a></td>
      <td><?=$req_date?></td>
      <td><?=$cus_name?></td>
      <td><?=$user_name?></td>
    </tr>
    <?php
  }
  $sql->close();
}

//get general sample list
function generalSampleList(){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT grn_no, grn_date, customer_name, grade_name, grn_qty, grn_mc, pre_quality.remarks FROM grn 
                        JOIN grades USING (grade_id) JOIN pre_quality USING(grn_no) JOIN customer 
                        WHERE grn.customer_id=customer.customer_id AND pre_quality.grn_no <> 0");
  $sql->execute();
  $sql->bind_result($grnNo, $date, $client, $grade, $qty, $mc, $remarks);
 
  while ($sql->fetch()){
    ?>
    <tr>
      <td><a href="../quality/qualityAssessment?grnNo=<?=$grnNo?>"> <?=$grnNo?></a></td>
      <td><?=$date?></td>
      <td><?=$client?></td>
      <td><?=$grade?></td>
      <td><?=$qty?></td>
      <td><?=$mc?></td>
      <td><?=$remarks?></td>
    </tr>

    <?php
  }
}

//getting full name
function getFullName($nameCol, $table, $idCol, $id){
  include "connlogin.php";
  $sql = $conn->prepare("SELECT $nameCol FROM $table WHERE $idCol=? ");
  $sql->bind_param("s", $id);
  $sql->execute();
  $sql->bind_result($name);
  $sql->fetch();
  return $name;

}



?>