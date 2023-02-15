<?php
// require_once "connlogin.php";
//function that tests for empty fields
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

 //function that checks for the length of password
 function passLength($password){
  if(!strlen($password)>=8){
    $result = true;
  }else{
    $result = false;
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
    header("location:../signup.php?error=stmtfailed");
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
    header("location:../signup.php?error=stmtfailed");
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
  header("location:../index.php?error=successfully");
  exit();
 }
 
 //login
 
function loginInputEmpty($username,$password){

  if(empty($username)||empty($password)){
  $result=true;
  } else{
    $result=false;
  }

  return $result;
}

function  loginUser($username,$password)
{
  $userExists=validUsernameEmail($username,$username);

  if($userExists===false)
  {
    header("location:../index.php?message=wrongdetails");
    exit();
  }

  $hashedPwd=$userExists["UserPassword"];

  $checkPwd=password_verify($password,$hashedPwd);

  if($checkPwd===false)
  {
    header("location:../index.php?message=incorrectpassword");
    exit();
  }

  else if($checkPwd===true)
  {
    // session_start();
    error_reporting(1);

    include "connlogin.php";
    $query="SELECT * FROM members WHERE UserName=? OR EmailAddress=?";
    $stmt=$pdo->prepare($query);

    $stmt->bindParam(1,$username,PDO::PARAM_STR);
    $stmt->bindParam(2,$username,PDO::PARAM_STR);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
    $privilege=$row["Access"];//getting access privilege
    $full_name=$row["FullName"];

    //session_variables
    $_SESSION["Access"]=$privilege;
    $_SESSION["fullName"]=$full_name;
    $_SESSION["userName"]=$userExists["UserName"];
    $_SESSION["userEmail"]=$userExists["EmailAddress"];
    // echo  $_SESSION["userEmail"];
    header("location:../home/forms/index.php");
    exit();
  
    } 


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
  $queryCustomer = "SELECT customer_id, customer_name FROM factory.customer";
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


// Coffee Grades
function coffeeGrades(){
  include "connlogin.php"; 
  $query = "SELECT grade_id, grade_name FROM grades";
  if ($stmt = $conn->prepare($query)) {
      $stmt->execute();
      $stmt->bind_result($field1, $field2);
      echo '<option></option>';
      while ($stmt->fetch()) {
          echo "<option value='".$field1."--".$field2."'>$field2</option>";
      }
      $stmt->close();
  }
}


// Getting next document number for front end
// function nextDocNumber($table, $columName, $prefix){
//   include "connlogin.php"; 
//   $nextNoSql = "SELECT max($columName) AS numbers FROM $table";
//   $nextNoQuery = $conn->query($nextNoSql);
//   $nextNoResult = mysqli_fetch_array($nextNoQuery);
//   $number = $nextNoResult['numbers'];
//   $nextNo = intval($number) +1;
//   $docNumber = "";
//   if ($number === 0){
//     $docNumber = $prefix."-0001";
//   }else{
//     if ($nextNo<10){
//         $docNumber = $prefix."-000".$nextNo;
//     }
//     elseif ($nextNo<100){
//         $docNumber = $prefix."-00".$nextNo;
//     }elseif ($nextNo<1000){
//         $docNumber = $prefix."-0".$nextNo;
//     }else{
//       $docNumber = $prefix."-".$nextNo;}
//     }
//   return $docNumber;
// }


// database table document number
// function documentNumber($table, $columName){
//   include "connlogin.php"; 
//   $nextNoSql = "SELECT max($columName) AS numbers FROM $table";
//   $nextNoQuery = $conn->query($nextNoSql);
//   $nextNoResult = mysqli_fetch_array($nextNoQuery);
//   $number = $nextNoResult['numbers'];
//   return intval($number) +1;
// }


// Customer List
// function GetCustomerList(){
//   include "connlogin.php"; 
//   $queryCustomer = "SELECT customer_id, customer_name FROM factory.customer";
//   if ($stmt = $conn->prepare($queryCustomer)) {
//   $stmt->execute();
//   $stmt->bind_result($customer_id, $customer_name);
//   echo '<option></option>';
//   while ($stmt->fetch()) {
//       echo '<option value="'.$customer_id.' '.$customer_name.'">'.$customer_id.' '.$customer_name.'</option>';
//   }
//   $stmt->close();
// }
// }


// Coffee Grades
// function coffeeGrades(){
//   include "connlogin.php"; 
//   $query = "SELECT grade_id, grade_name FROM grades";
//   if ($stmt = $conn->prepare($query)) {
//       $stmt->execute();
//       $stmt->bind_result($field1, $field2);
//       echo '<option></option>';
//       while ($stmt->fetch()) {
//           echo "<option value='".$field1."--".$field2."'>$field2</option>";
//       }
//       $stmt->close();
//   }
// }


// Valuation customer Picker
function valuationCustomer(){
  include "connlogin.php"; 
  $sql = "SELECT batch_report_no, customer_name, grade_name, batch_order_input_qty FROM batch_reports_summary
          JOIN batch_processing_order USING (batch_order_no)
          JOIN grn USING (batch_order_no)
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
            echo '<input type="text" value="" id="highGrade'.$itemNo.'Code" readonly name="highGrade'.$itemNo.'Code" class="itmNameInput" style="grid-column: 1; display:none">';
            echo '<input type="text" value="" id="highGrade'.$itemNo.'Name" readonly name="highGrade'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">';
            echo '<select id="highGrade'.$itemNo.'Select" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">';
                CoffeeGrades();
            echo '</select>
        </div>
        
    </td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'Yield" readonly name="highGrade'.$itemNo.'Yield" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'Qty" name="highGrade'.$itemNo.'Qty" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceUs" name="highGrade'.$itemNo.'PriceUs" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceCts" name="highGrade'.$itemNo.'PriceCts" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'PriceUgx" name="highGrade'.$itemNo.'PriceUgx" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'AmountUs" readonly name="highGrade'.$itemNo.'AmountUs" class="tableInput"></td>';
    echo '<td><input type="number" value="" id="highGrade'.$itemNo.'AmountUgx" readonly name="highGrade'.$itemNo.'AmountUgx" class="tableInput"></td>
    </tr>';
}


// Batch Report customer list
function selectBatchReportCustomer(){
  include "connlogin.php"; 
  $sql = "SELECT batch_order_no, customer_name, grade_name, batch_order_input_qty, batch_order_mc
          FROM batch_processing_order
          JOIN grn USING (batch_order_no) 
          JOIN customer USING (customer_id) 
          WHERE (processed=0)";
  $getList = $conn->query($sql);
  $row = mysqli_fetch_all($getList);
  if (count($row)==0){
      echo "<option>  There was no processing order found!</option>";
  }else{
      echo "<option>Select Processing Order</option>";
      for ($customer=0; $customer<count($row); $customer++){
          
          echo "<option>".$row[$customer][0]."--".$row[$customer][1]."--".$row[$customer][2]."--".$row[$customer][3]." Kg"."</option>";
      }
  }
}
?>