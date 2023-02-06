<?php
if(isset($_GET["formmsg"]))
{
  if($_GET["formmsg"]=="success")
  {
    
    ?>
    <div class="text-primary text-center" style="font-size:16px;" id="messageContainer">
      <p>Data has been submitted successfully into the Database</p>
    </div>
    <script>
      var divElement=document.getElementById("messageContainer");
      //function to erase message after sometime
      function messageErase()
      {
        divElement.style.display="none";
      }
      setTimeout(messageErase,8000);//erases message after 8 seconds
    </script>
    <?php
  }

}
?>