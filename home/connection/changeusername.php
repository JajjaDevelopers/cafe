<?php
 include_once("../private/connlogin.php");
 if(isset($_POST["changeName"]))
 {
  session_start();
  $newName=$_POST["newName"];
  $passWd=$_POST["pass"];
  //generating errors
  if(empty($newName) || empty($passWd) )
  {
    header("location:../forms/settings.php?error=empty");
    exit();
  }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$newName))
  {
    header("location:../forms/settings.php?error=nonealphanumericcharacters");
    exit();
  }

  $query="SELECT * FROM members WHERE UserName=?;";
  $stmt=$pdo->prepare($query);
  if(!$stmt)
  {
    echo "An unexpected error occure! Try again";
  }else{
    $stmt->bindParam(1,$newName,PDO::PARAM_STR);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row){
      header("location:../forms/settings.php?error=nameexists");
      exit();
    }else{
      $query="SELECT UserPassword FROM members WHERE UserName=?;";
      $stmt=$pdo->prepare($query);
      $stmt->bindParam(1,$_SESSION["userName"],PDO::PARAM_STR);
      $stmt->execute();
      $result=$stmt->fetch(PDO::FETCH_ASSOC);
      if(!$result)
      {
        echo "Failed to execute";
      }else{
        $hashedpass=$result["UserPassword"];
        // echo $hashedpass;
        $verifyPwd=password_verify($passWd,$hashedpass);
        if(!$verifyPwd)
        {
          header("location:../forms/settings.php?error=wrongpassword");
          exit();
        }else{
          $query="UPDATE members SET UserName=? WHERE UserPassword=?;";
          $stmt=$pdo->prepare($query);
          if(!$stmt){
            echo "An unexpected error occure!Try again";
          }else{
            $stmt->bindParam(1,$newName,PDO::PARAM_STR);
            $stmt->bindParam(2,$hashedpass,PDO::PARAM_STR);
            $stmt->execute();
            $pdo=null;
            $_SESSION["userName"]=$newName;
            header("location:../forms/settings.php?error=changenamesuccess");
            exit();
          }
          
        }
      }
     
    }
  }
  
 }
?>
