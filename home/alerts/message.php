<?php
if(isset($_GET["formmsg"]))
{
  if($_GET["formmsg"]=="success")
  {
    
    ?>
    <div class="alert alert-success alert-dismissible   rounded-0 fade show" role="alert" style="background-color:green">
        <p class="text-center text-white" style="font-size:medium">Data recorded successfully! You can make another Entry.</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <!-- <script>
      var divElement=document.getElementById("messageContainer");
      //function to erase message after sometime
      function messageErase()
      {
        divElement.style.display="none";
      }
      setTimeout(messageErase,8000);//erases message after 8 seconds
    </script> -->
    <?php
  }

}
?>