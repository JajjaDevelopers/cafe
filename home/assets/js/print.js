document.getElementById("print").addEventListener("click",()=>{

  document.getElementById("footer").style.display="none";
  document.getElementById("divheader").style.display="none";
  document.getElementById("sidebar").style.display="none";
  document.getElementById("btnback").style.display="none";
  document.getElementById("print").style.display="none";
  window.print();
  document.getElementById("print").style.display="block";
  
  document.getElementById("footer").style.display="block";
  document.getElementById("divheader").style.display="block";
  document.getElementById("sidebar").style.display="block";
  document.getElementById("btnback").style.display="block";
  document.getElementById("print").style.display="block";
})