<?php $pageTitle="Settings"; ?>
<?php include "header.php";?>
<div class="container">
  <div class="row">
    <div class="col" id="cardcontent">
      <div class="card mt-4">
      <div class="card-header">
        <h1>Settings</h1>
      </div>
      <div class="card-body" id="settingsDiv">
        <ol style="list-style-type: none;">
          <li><a href="javascript:void(0)" id="passwordchange" class="link">Change Password</a></li>
          <li><a href="javascript:void(0)" id="usernamechange" class="link">Change username</a></li>
        </ol>
      </div>
    </div>

    </div>
  </div>
  <div class="row">
    <div>
      <div class="container text-center text-danger bg-white"  id="errors">
        <?php
          include "../alerts/settingerrors.php";
        ?>
      </div>
      <div class="col" id="displayform" class="justify-content-center">
      </div>
    </div>
  </div>
</div>

<script>
  let file;
  var divEl=document.getElementById("settingsDiv").getElementsByTagName("ol")[0];
  var elLink1=divEl.getElementsByTagName("li")[0].getElementsByTagName("a")[0];
  var elLink2=divEl.getElementsByTagName("li")[1].getElementsByTagName("a")[0];
  const elCard=document.getElementById("cardcontent");
  // console.log(elCard);
  // console.log(elLink2);
  // var userName=document.getElementById("usernamechange");
  // var passwordForm=document.getElementById("passwordform");
  // var changenameForm=document.getElementById("changenameform");
  const elDisplay=document.getElementById("displayform")
  var link=document.querySelectorAll(".link");
  let linkId;
  link.forEach(linkClick=>linkClick.addEventListener("click",(event)=>{
    // alert("God is amazingly good!");
    linkId=event.target.id;
    // console.log(linkId);
    if(linkId=="passwordchange")
    {
      file="passwordchange";
    }else{
      file="usernamechange";
    };

      var request=new XMLHttpRequest();
      request.open("GET",file+".php",true);
      request.onload=()=>{
      var data=request.responseText;
      elDisplay.innerHTML=data;
      elCard.style.display="none";
    }
    request.send();
  }));

  var divElement=document.getElementById("errors");
  //function to erase message after sometime
  function messageErase()
  {
    divElement.style.display="none";
  }
  setTimeout(messageErase,8000);//erases message after 8 seconds
</script>
<?php include "footer.php";?>