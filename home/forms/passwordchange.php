<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head> -->
<style>
     #changepwdbtn:hover{
           background-color:green;
      }
      #changepwdbtn:focus{
          background-color:#765341;
      }
      #changepwdbtn:hover{
          background-color:green;
      }
      #changepwdbtn:focus{
          background-color:#765341;
      }
      #changepwdform{
          border:none;
          background-color: white;
          font-size:medium;
          color:black;
      }
  </style>
<!-- <body> -->
  <div class="container text-center">
    <form action="../connection/changepassword.php" method="POST" id="changepwdform">
      <div class="row">
      <div class="form-floating col-md-6">
        <input type="password" name="newPassword" class="form-control">
        <label for="newpassword" class="text-center">Enter New Password</label>
      </div>
      <div class="form-floating col-md-6 ">
        <input type="password" name="newPasswordConf" class="form-control">
        <label for="newpassword" class="text-center">Confirm New Password</label>
      </div>
      </div>
      <div class="form-group">
      <input type="submit" id="changepwdbtn" name="changebtn" class="btn btn-primary my-3 " value="Change Password">
      </div>
    </form>
  </div>
<!-- </body>
</html> -->