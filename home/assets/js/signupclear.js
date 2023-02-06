var divElement=document.getElementById("signupclear");
//function to erase message after sometime
function messageErase()
{
  divElement.style.display="none";
}
setTimeout(messageErase,8000);//erases message after 8 seconds