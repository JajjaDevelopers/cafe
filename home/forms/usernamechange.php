
  <style>
     #changenamebtn:hover{
    background-color:green;
      }
      #changenamebtn:focus{
          background-color:#765341;
      }
      #changenamebtn:hover{
          background-color:green;
      }
      #changenamebtn:focus{
          background-color:#765341;
      }
      #changenameform{
          border:none;
          background-color: white;
          font-size:medium;
          color:black;
      }
  </style>
<div class=" container text-center">
    <form action="../connection/changeusername.php" method="POST" id="changenameform">
      <!-- <h5 class="text-center">Change Username</h5> -->
      <div class="row">
      <div class="form-floating col-md-6">
        <input type="text" name="newName" class="form-control">
        <label for="username" class="text-center">Enter New Username</label>
      </div>
      <div class="form-floating col-md-6">
        <input type="password" name="pass" class="form-control">
        <label for="username" class="text-center">Enter your password to change name</label>
      </div>
      </div>
      <div class="form-group">
      <input type="submit" id="changenamebtn" name="changeName" class="btn btn-primary my-3  text-center" value="Change Username">
      </div>
    </form>
  </div>
